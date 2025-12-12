@extends('admin.layouts.main')
@section('title', 'Generate Salary')

@section('content')
<div class="px-6 py-8">

    {{-- Heading --}}
    <form method="POST" action="{{ route('admin.salary.generate.run') }}">
        @csrf
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold">Generate Salary</h1>
                <p class="text-sm text-gray-500 mt-1">Generate and manage salaries for selected month</p>
            </div>

            {{-- Month Selector and Generate Button --}}
            <div class="flex items-center gap-3">
                <input type="month" name="month" required
                    class="border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-400 focus:border-blue-400"
                    value="{{ $stats['selected_month_year'] }}">

                <button type="submit" 
                    class="px-5 py-2.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 shadow-sm"
                    @disabled($stats['status'] !== 'Not Generated')>
                    {{ $stats['status'] === 'Not Generated' ? 'Generate Salary' : 'Regenerate Not Allowed' }}
                </button>
            </div>
        </div>
    </form>
    
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
    @endif

    {{-- Stats Summary --}}
    <div class="grid grid-cols-3 gap-5 mb-8">

        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-500">Employees Processed</div>
            <div class="text-2xl font-semibold mt-1">{{ $stats['generated_count'] }} / {{ $stats['total_employees'] }}</div>
        </div>

        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-500">Total Net Pay ({{ $stats['period'] }})</div>
            <div class="text-2xl font-semibold mt-1">₹ {{ number_format($stats['total_salary'], 0) }}</div>
        </div>

        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-500">Generation Status</div>
            <div class="text-2xl font-semibold mt-1 
                {{ $stats['status'] === 'Paid' ? 'text-green-600' : ($stats['status'] === 'Not Generated' ? 'text-red-600' : 'text-yellow-600') }}">
                {{ $stats['status'] }}
            </div>
        </div>

    </div>

    {{-- Salary Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 border-b">
                    <th class="px-5 py-3 font-medium">Employee</th>
                    <th class="px-5 py-3 font-medium">Gross Pay</th>
                    <th class="px-5 py-3 font-medium">Net Pay</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-800 divide-y divide-gray-100">
                @forelse ($payrollRecords as $record)
                    @php
                        $statusClass = match ($record->status) {
                            'Paid' => 'bg-green-100 text-green-700',
                            'Generated' => 'bg-yellow-100 text-yellow-700',
                            default => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs">
                                {{ strtoupper(substr($record->user->name, 0, 2)) }}
                            </div>
                            {{ $record->user->name }}
                        </td>

                        <td class="px-5 py-3">₹ {{ number_format($record->gross_salary, 2) }}</td>
                        <td class="px-5 py-3 font-semibold">₹ {{ number_format($record->net_pay, 2) }}</td>

                        <td class="px-5 py-3">
                            <span class="px-3 py-1 text-xs rounded-full {{ $statusClass }}">{{ $record->status }}</span>
                        </td>

                        <td class="px-5 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <button class="px-3 py-1.5 text-xs bg-gray-200 hover:bg-gray-300 rounded">View Details</button>
                                
                                @if ($record->status === 'Generated')
                                    {{-- Mark Paid Action --}}
                                    <form action="{{ route('admin.salary.generate.markPaid', $record->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 text-xs bg-blue-100 hover:bg-blue-200 text-blue-600 rounded">Mark Paid</button>
                                    </form>
                                @endif
                                
                                <button class="px-3 py-1.5 text-xs bg-red-100 hover:bg-red-200 text-red-600 rounded">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-500">
                            No salary records found for {{ $stats['period'] }}. Click 'Generate Salary' to create them.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection