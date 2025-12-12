<?php

// app/Http/Controllers/Admin/SalaryGenerationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayrollRecord;
use App\Models\SalaryHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryGenerationController extends Controller
{
    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }
    
    // --- INDEX: Display the generated salaries for a given month ---
    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        
        // Default to the previous month
        $defaultMonth = Carbon::now()->subMonth()->format('Y-m');
        $selectedMonthYear = $request->input('month', $defaultMonth);
        
        list($year, $month) = explode('-', $selectedMonthYear);

        // Fetch payroll records for the selected period
        $payrollRecords = PayrollRecord::where('hospital_id', $hospitalId)
            ->where('year', $year)
            ->where('month', $month)
            ->with('user.employee') // Load employee details for display
            ->get();
            
        // Calculate summary statistics
        $stats = [
            'total_employees' => User::where('hospital_id', $hospitalId)->whereIn('role', ['Doctor', 'Nurse', 'Staff'])->count(),
            'total_salary' => $payrollRecords->sum('net_pay'),
            'status' => $payrollRecords->isEmpty() ? 'Not Generated' : (
                $payrollRecords->where('status', 'Paid')->count() == $payrollRecords->count() ? 'Paid' : 'Pending'
            ),
            'generated_count' => $payrollRecords->count(),
            'period' => Carbon::createFromDate($year, $month, 1)->format('F Y'),
            'selected_month_year' => $selectedMonthYear,
        ];
        
        return view('admin.pages.salary.generate.index', compact('payrollRecords', 'stats'));
    }
    
    // --- GENERATE SALARY FOR ALL EMPLOYEES FOR A MONTH ---
    public function generate(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        
        $validated = $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);
        
        list($year, $month) = explode('-', $validated['month']);
        
        // 1. Check if salaries already exist for the entire hospital for this period
        if (PayrollRecord::where('hospital_id', $hospitalId)->where('year', $year)->where('month', $month)->exists()) {
            return back()->with('error', "Salary records for {$validated['month']} already exist. Delete them first if you need to regenerate.");
        }

        // 2. Fetch required data
        $employees = User::where('hospital_id', $hospitalId)
            ->whereIn('role', ['Doctor', 'Nurse', 'Staff'])
            ->with('employee', 'employeeSalaryHead.salaryHead')
            ->get();
            
        $globalHeads = SalaryHead::where('hospital_id', $hospitalId)->get();
        $basicHead = $globalHeads->where('is_basic', true)->first();

        if (!$basicHead) {
             return back()->with('error', "Basic Salary Head is not configured. Cannot generate payroll.");
        }
        
        $newRecords = [];

        DB::beginTransaction();
        try {
            // 3. Process each employee
            foreach ($employees as $user) {
                
                $result = $this->calculateEmployeeSalary($user, $globalHeads, $basicHead);
                
                // Save the new payroll record
                $newRecords[] = [
                    'hospital_id' => $hospitalId,
                    'user_id' => $user->id,
                    'year' => $year,
                    'month' => $month,
                    'gross_salary' => $result['gross_salary'],
                    'total_deductions' => $result['total_deductions'],
                    'net_pay' => $result['net_pay'],
                    'status' => 'Generated',
                    'components' => json_encode($result['components']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($newRecords)) {
                PayrollRecord::insert($newRecords);
            }

            DB::commit();
            return redirect()->route('admin.salary.setup.generate', ['month' => $validated['month']])
                             ->with('success', "Salary successfully generated for {$employees->count()} employees for {$validated['month']}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error during salary generation: ' . $e->getMessage());
        }
    }
    
    // --- STATUS UPDATE (Mark Paid) ---
    public function markPaid(PayrollRecord $record)
    {
        if ($record->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        if ($record->status !== 'Generated') {
             return back()->with('error', 'Only Generated payrolls can be marked Paid.');
        }

        $record->status = 'Paid';
        $record->save();

        return back()->with('success', "Payroll for {$record->user->name} marked as PAID.");
    }

    // --- UTILITY: Salary Calculation Logic ---
    private function calculateEmployeeSalary($user, $globalHeads, $basicHead)
    {
        $components = [];
        $grossSalary = 0;
        $totalDeductions = 0;
        $netPay = 0;
        
        // 1. Get the employee's customized head values
        $customHeads = $user->employeeSalaryHead->keyBy('salary_head_id');
        
        // 2. Identify the employee's Basic Salary value
        $basicValue = $customHeads->get($basicHead->id)->assigned_value ?? $basicHead->value;

        // 3. Process all heads
        foreach ($globalHeads as $head) {
            $value = $customHeads->get($head->id)->assigned_value ?? $head->value;
            $calculatedAmount = 0;
            
            // --- Calculation ---
            if ($head->calculation_type === 'Fixed') {
                $calculatedAmount = $value;
            } elseif ($head->calculation_type === 'Percentage') {
                // Percentage is always based on the Basic Salary
                $calculatedAmount = $basicValue * $value; // value is stored as a float (e.g., 0.40)
            }
            
            // --- Categorization ---
            if ($head->type === 'Earning' || $head->type === 'Allowance') {
                $grossSalary += $calculatedAmount;
            } elseif ($head->type === 'Deduction') {
                $totalDeductions += $calculatedAmount;
            }
            
            $components[$head->name] = [
                'type' => $head->type,
                'amount' => round($calculatedAmount, 2),
            ];
        }
        
        // Final calculation
        $netPay = $grossSalary - $totalDeductions;
        
        return [
            'gross_salary' => round($grossSalary, 2),
            'total_deductions' => round($totalDeductions, 2),
            'net_pay' => round($netPay, 2),
            'components' => $components,
        ];
    }
}