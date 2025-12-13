@extends('admin.layouts.main')
@section('title', 'Hospital Admin Dashboard')

@section('content')
<div class="px-6 py-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Overview</h1>

    {{-- 1. Metric Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        {{-- Card 1: Total Employees --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-5">
            <p class="text-sm font-medium text-gray-500">Total Employees</p>
            <div class="mt-1 text-3xl font-bold text-indigo-600">{{ $metrics['employeeCount'] }}</div>
        </div>

        {{-- Card 2: Pending Leave Requests --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-5">
            <p class="text-sm font-medium text-gray-500">Pending Leaves</p>
            <div class="mt-1 text-3xl font-bold text-yellow-600">{{ $metrics['pendingLeaves'] }}</div>
        </div>

        {{-- Card 3: Today's Check-ins --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-5">
            <p class="text-sm font-medium text-gray-500">Today's Check-ins</p>
            <div class="mt-1 text-3xl font-bold text-green-600">{{ $metrics['todayCheckIns'] }}</div>
        </div>
        
        {{-- Card 4: YTD Payroll --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-5">
            <p class="text-sm font-medium text-gray-500">YTD Net Payroll</p>
            <div class="mt-1 text-xl font-bold text-gray-800">₹ {{ number_format($metrics['ytdNetPay'], 0) }}</div>
        </div>
    </div>
    
    {{-- 2. Detail Panels (Recent Activity & Upcoming Schedule) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Recent Leave Requests --}}
        <div class="lg:col-span-1 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Recent Leave Requests</h3>
                <a href="{{ route('admin.pages.leave-management.index', ['status' => 'Pending']) }}" class="text-xs text-indigo-600 hover:text-indigo-800">View all pending</a>
            </div>

            <ul class="divide-y divide-gray-100">
                @forelse ($recentLeaves as $leave)
                    <li class="p-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <div class="font-medium text-sm text-gray-900">{{ $leave->user->name }}</div>
                            <div class="text-xs text-gray-500">
                                {{ Str::title($leave->type) }} ({{ $leave->start_date->format('M d') }})
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium 
                            {{ $leave->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : ($leave->status === 'Approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ $leave->status }}
                        </span>
                    </li>
                @empty
                    <li class="p-4 text-center text-gray-500 text-sm">No recent requests.</li>
                @endforelse
            </ul>
        </div>
        
        {{-- RIGHT: Upcoming Duties --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Upcoming Duty Schedule (Next 7 Days)</h3>
                <a href="{{ route('admin.pages.duty-management.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800">View full schedule</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($upcomingDuties as $duty)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $duty->date->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $duty->date->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $duty->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::title($duty->user->role) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $duty->assignedDepartment->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $duty->shift->name ?? 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">No duties scheduled for the next 7 days.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection