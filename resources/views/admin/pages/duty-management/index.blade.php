{{-- resources/views/admin/pages/duty-management/index.blade.php --}}
@extends('admin.layouts.main')

@section('title', 'Duty Management')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
  <form method="GET" action="{{ route('admin.pages.duty-management.index') }}" id="filterForm">
    
    <div class="py-6">
      <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Duty Management</h1>
      <p class="mt-1 text-sm text-gray-500">Manage duty assignments for employees on {{ $date }}.</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Left: Date Picker + Filters --}}
        <aside class="space-y-6 lg:col-span-1">
            
            {{-- Date Picker Card --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <label for="duty-date" class="mb-2 block text-sm font-medium text-gray-700">Pick a date</label>
                <div class="relative">
                    <input
                        id="duty-date"
                        name="duty_date"
                        type="date"
                        class="w-full rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 text-gray-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        value="{{ $date }}"
                        onchange="document.getElementById('filterForm').submit()"
                    >
                </div>
            </div>

            {{-- Actor Type Filter --}}
            <div class="space-y-2">
                <label for="actor_type" class="text-sm font-medium text-gray-700">Actor Type</label>
                <div class="relative">
                    <select
                        id="actor_type"
                        name="actor_type"
                        class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 text-gray-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        onchange="document.getElementById('filterForm').submit()"
                    >
                        <option value="">All Actors</option>
                        @foreach ($actorTypes as $actor)
                            <option value="{{ $actor }}" @selected(request('actor_type') == $actor)>{{ $actor }}</option>
                        @endforeach
                    </select>
                    <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </aside>

    </form> {{-- End of Filter Form (GET) --}}
    
    
    <section class="lg:col-span-2">
      <form method="POST" action="{{ route('admin.pages.duty-management.bulkStore') }}">
        @csrf
        <input type="hidden" name="duty_date" value="{{ $date }}">

        {{-- Filter chips (UI fix) --}}
        <div class="mb-3 flex items-center gap-2 text-sm">
            <span class="text-gray-600">Assignment Status:</span>
            <span class="rounded-full bg-blue-100 px-3 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-200">Assigned</span>
            <span class="rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-700 ring-1 ring-inset ring-gray-200">Not Assigned</span>
            <span class="rounded-full bg-red-100 px-3 py-1 font-medium text-red-700 ring-1 ring-inset ring-red-200">On Leave</span>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            <th class="px-6 py-4">Employee</th>
                            <th class="px-6 py-4">Home Dept</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Assigned Dept</th> 
                            <th class="px-6 py-4">Shift</th>
                            <th class="px-6 py-4 text-right">
                                <label class="inline-flex items-center gap-2">
                                    <span class="text-[11px] font-medium text-gray-500">Assign</span>
                                    <input type="checkbox" id="selectAll" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                </label>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse ($employees as $employee)
                            @php
                                $userId = $employee->id;
                                $currentStatus = $statusMap[$userId] ?? 'Not Assigned';
                                $currentShiftId = $assignments[$userId] ?? null;
                                $currentAssignedDeptId = $assignedDeptMap[$userId] ?? null;
                                $uniquePrefix = "duty_assignments[{$userId}]"; 
                                
                                // FIX 1: Set PHP flag for initial disabled state
                                $isDisabled = ($currentStatus != 'Assigned');
                            @endphp
                            
                            <tr class="hover:bg-gray-50/60">
                                {{-- Employee Name --}}
                                <td class="px-6 py-4 text-gray-800">{{ $employee->name }} ({{ $employee->role }})</td>
                                
                                {{-- Home Department --}}
                                <td class="px-6 py-4">{{ $employee->employee->department->name ?? 'N/A' }}</td>
                                
                                {{-- Status Dropdown --}}
                                <td class="px-6 py-4">
                                    <div class="relative">
                                        <select name="{{ $uniquePrefix }}[status]"
                                            class="status-select w-36 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                            data-user-id="{{ $userId }}">
                                            @foreach (['Assigned', 'Not Assigned', 'On Leave'] as $status)
                                                <option value="{{ $status }}" @selected($currentStatus == $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                                    </div>
                                </td>
                                
                                {{-- Assigned Department Dropdown --}}
                                <td class="px-6 py-4">
                                    <div class="relative">
                                        <select name="{{ $uniquePrefix }}[department_id]"
                                            class="assigned-dept-select w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                            {{ $isDisabled ? 'disabled' : '' }}>
                                            <option value="">— Select Dept —</option>
                                            @foreach ($departments as $dept)
                                                <option value="{{ $dept->id }}" @selected($currentAssignedDeptId == $dept->id)>
                                                    {{ $dept->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                                    </div>
                                </td>
                                
                                {{-- Shift Dropdown --}}
                                <td class="px-6 py-4">
                                    <div class="relative">
                                        <select name="{{ $uniquePrefix }}[shift_id]"
                                            class="shift-select w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                            {{ $isDisabled ? 'disabled' : '' }}>
                                            <option value="">— Select Shift —</option>
                                            @foreach ($shifts as $shift)
                                                <option value="{{ $shift->id }}" @selected($currentShiftId == $shift->id)>
                                                    {{ $shift->name }} ({{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}–{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                                    </div>
                                </td>
                                
                                {{-- Checkbox (Bulk Select/Action) --}}
                                <td class="px-6 py-4 text-right">
                                    <input type="checkbox" name="bulk_select[]" value="{{ $userId }}" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No employees found matching the current filter settings.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bulk save button --}}
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button type="button" class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200">Apply selected shift until</button>
                <div class="relative">
                    <input type="date" name="bulk_until_date" placeholder="mm/dd/yyyy" class="w-40 rounded-xl border border-gray-200 px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>

            <button type="submit" class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                Bulk Save Assignments
            </button>
        </div>
      </form>
    </section>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('tbody');

        // --- Toggle Shift and Department Select based on Status ---
        tableBody.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function () {
                const row = this.closest('tr');
                const shiftSelect = row.querySelector('.shift-select');
                const deptSelect = row.querySelector('.assigned-dept-select');
                
                // Get the current value
                const statusValue = this.value; 

                if (statusValue === 'Assigned') {
                    // ENABLE
                    shiftSelect.disabled = false;
                    deptSelect.disabled = false;
                    shiftSelect.focus();
                } else {
                    // DISABLE
                    shiftSelect.disabled = true;
                    deptSelect.disabled = true;
                    
                    // Clear values when status is not Assigned
                    // This is important for data integrity when saving "On Leave" or "Not Assigned"
                    shiftSelect.value = ''; 
                    deptSelect.value = ''; 
                }
            });
        });

        // --- Select All Checkbox Logic ---
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                // Selects checkboxes in the last column
                const checkboxes = tableBody.querySelectorAll('input[name="bulk_select[]"]');
                checkboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
            });
        }
    });
</script>
@endsection