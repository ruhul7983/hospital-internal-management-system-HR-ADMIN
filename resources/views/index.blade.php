<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Internal Management System - Payslip</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Hospital Internal Management System</h2>
        <h4>Payslip for <span id="month">{{ $payroll->month }}</span></h4>

        <div class="employee-info">
            <p><strong>Name:</strong> <span id="name">{{ $employee->name }}</span></p>
            <p><strong>Designation:</strong> <span id="designation">{{ $employee->designation }}</span></p>
        </div>

        <hr>

        <table class="payslip-table">
            <thead>
                <tr>
                    <th>Earnings</th>
                    <th>Deductions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Base Salary: <span id="baseSalary">{{ $payroll->employee->base_salary }}</span> <br>
                        Overtime: <span id="overtime">{{ $payroll->overtime_hours * 200 }}</span>
                    </td>
                    <td>
                        Deductions: <span id="deductions">{{ $payroll->deductions }}</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Net Salary: <span id="netSalary">{{ $payroll->net_salary }}</span></h3>
    </div>

    <script src="script.js"></script>
</body>
</html>
