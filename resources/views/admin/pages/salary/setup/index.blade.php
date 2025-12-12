@extends('admin.layouts.main')
@section('title', 'Salary Setup')

@section('content')
<div class="px-6 py-8">

    <h1 class="text-2xl font-semibold mb-6">Salary Setup</h1>
    
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT: USER LIST --}}
        <div class="col-span-12 lg:col-span-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-5 py-4 border-b flex justify-between items-center">
                <h2 class="font-semibold text-gray-700">Employees ({{ $employeeList->count() }})</h2>
                <input type="text" id="searchInput" placeholder="Search..."
                    class="text-sm rounded-md border-gray-300 px-2 py-1 w-32 focus:ring-blue-400 focus:border-blue-400">
            </div>

            <div class="divide-y max-h-[650px] overflow-y-auto" id="employeeListContainer">
                
                @forelse ($employeeList as $employee)
                    @php
                        $isActive = $selectedUser && $selectedUser->id === $employee->id;
                        $avatarText = strtoupper(substr($employee->name, 0, 2));
                    @endphp
                    <a href="{{ route('admin.salary.setup.index', ['user_id' => $employee->id]) }}" 
                       class="employee-item w-full flex items-center gap-3 px-5 py-4 cursor-pointer transition 
                              {{ $isActive ? 'bg-blue-100 hover:bg-blue-200' : 'hover:bg-gray-50' }}"
                       data-name="{{ strtolower($employee->name) }}">
                        
                        <div class="w-10 h-10 rounded-full {{ $isActive ? 'bg-blue-600' : 'bg-gray-300' }} text-white flex items-center justify-center font-semibold text-sm">
                            {{ $avatarText }}
                        </div>
                        <div class="text-left">
                            <div class="font-medium text-gray-800">{{ $employee->name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::title($employee->role) }}</div>
                        </div>
                    </a>
                @empty
                    <p class="p-5 text-gray-500 text-sm">No active employees found.</p>
                @endforelse

            </div>
        </div>

        {{-- RIGHT: SALARY DETAILS --}}
        <div class="col-span-12 lg:col-span-8 bg-white border border-gray-200 rounded-xl shadow-sm">
            
            @if (!$selectedUser)
                <div class="p-6 py-20 text-center text-gray-500">
                    <h2 class="text-xl font-medium">Select an Employee to begin Salary Setup</h2>
                    <p class="mt-2">Click an employee's name from the list on the left to load their profile.</p>
                </div>
            @else
                <form method="POST" action="{{ route('admin.salary.setup.save', $selectedUser->id) }}">
                    @csrf

                    <div class="px-6 py-4 border-b">
                        <h2 class="text-lg font-semibold text-gray-800">Salary Setup - <span class="text-blue-600">{{ $selectedUser->name }}</span></h2>
                        <p class="text-sm text-gray-500">Assign or update salary structure for this employee.</p>
                    </div>

                    <div class="p-6 space-y-6">

                        {{-- Salary Heads --}}
                        <div class="space-y-4">
                            @forelse ($salaryHeadsData as $head)
                                @php
                                    $isEditable = $head->is_editable || $head->is_basic;
                                    $nameAttr = "head_value[{$head->id}]";
                                @endphp
                                
                                <div class="p-4 rounded-xl border flex justify-between items-center {{ $head->is_basic ? 'bg-indigo-50 border-indigo-200' : 'bg-gray-50 border-gray-200' }}">
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $head->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ $head->calculation_type }} ({{ $head->display_multiplier }})
                                        </div>
                                    </div>
                                    
                                    <input 
                                        type="number" 
                                        name="{{ $nameAttr }}" 
                                        value="{{ old($nameAttr, number_format($head->current_value, 2, '.', '')) }}"
                                        step="0.01" 
                                        min="0"
                                        class="rounded-md border-gray-300 w-40 text-right focus:ring-blue-600 focus:border-blue-600"
                                        {{ $isEditable ? 'required' : 'readonly' }}
                                    >
                                </div>
                            @empty
                                <p class="p-4 text-gray-500">No salary heads configured for this hospital. Please configure them first.</p>
                            @endforelse
                        </div>

                        {{-- Week Off UI --}}
                        <div class="mt-8">
                            <h3 class="font-medium text-gray-800 mb-3">Week Off Day</h3>

                            <div class="flex gap-2 flex-wrap">
                                @foreach ($weekOffDays as $day)
                                    @php
                                        $isSelected = old('week_off', $assignedWeekOff) == $day;
                                    @endphp
                                    <label class="cursor-pointer">
                                        <input type="radio" name="week_off" value="{{ $day }}" class="sr-only" {{ $isSelected ? 'checked' : '' }}>
                                        <div class="px-4 py-2 text-sm rounded-full border border-gray-300 hover:bg-gray-100 transition
                                                    {{ $isSelected ? 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700' : 'text-gray-700' }}">
                                            {{ $day }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <p class="text-xs text-gray-500 mt-1">Select the weekly off day for this employee.</p>
                            @error('week_off')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Save Button --}}
                        <div class="pt-4">
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-sm">
                                Save Salary Setup
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const employeeListContainer = document.getElementById('employeeListContainer');

    // Live search filter for employee list
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const employees = employeeListContainer.querySelectorAll('.employee-item');

        employees.forEach(item => {
            const employeeName = item.getAttribute('data-name');
            if (employeeName.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Handle radio button custom style (for week off days)
    employeeListContainer.parentElement.querySelector('.flex-wrap')?.addEventListener('change', function(e) {
        if (e.target.type === 'radio' && e.target.name === 'week_off') {
            const labels = this.querySelectorAll('label');
            labels.forEach(label => {
                const input = label.querySelector('input');
                const div = label.querySelector('div');
                if (input.checked) {
                    div.classList.add('bg-blue-600', 'text-white', 'border-blue-600', 'hover:bg-blue-700');
                    div.classList.remove('text-gray-700', 'hover:bg-gray-100');
                } else {
                    div.classList.remove('bg-blue-600', 'text-white', 'border-blue-600', 'hover:bg-blue-700');
                    div.classList.add('text-gray-700', 'hover:bg-gray-100');
                }
            });
        }
    });
});
</script>
@endsection