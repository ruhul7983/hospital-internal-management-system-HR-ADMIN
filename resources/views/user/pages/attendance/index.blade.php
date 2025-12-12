@extends("user.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Attendance History</h1>
                <p class="mt-1 text-sm text-gray-500">Viewing {{ $months[$currentMonth] }} {{ $currentYear }} (Total Working Days: {{ $metrics['working_days'] }})</p>
            </div>

            {{-- Month/Year Filter Form --}}
            <form method="GET" action="{{ route('user.attendance.index') }}" class="bg-white p-1.5 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-2">
                
                {{-- Month Select --}}
                <div class="relative">
                    <select name="month" class="appearance-none bg-gray-50 border border-transparent text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-32 p-2.5 pr-8 font-medium hover:bg-gray-100 transition-colors cursor-pointer">
                        @foreach ($months as $key => $name)
                            <option value="{{ $key }}" @selected($currentMonth == $key)>{{ $name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                {{-- Year Select --}}
                <div class="relative">
                    <select name="year" class="appearance-none bg-gray-50 border border-transparent text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-24 p-2.5 pr-8 font-medium hover:bg-gray-100 transition-colors cursor-pointer">
                        @foreach ($years as $yearOption)
                            <option value="{{ $yearOption }}" @selected($currentYear == $yearOption)>{{ $yearOption }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <button type="submit" class="bg-indigo-600 text-white p-2.5 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Metrics Cards --}}
    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            
            {{-- Total Working Days --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-50 rounded-md p-3">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Days</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $metrics['working_days'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Days Present --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-50 rounded-md p-3">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Days Present</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $metrics['days_present'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Late Arrivals --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-50 rounded-md p-3">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Late Arrivals</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $metrics['late_arrivals'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Days Absent --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-50 rounded-md p-3">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Days Absent</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $metrics['days_absent'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Attendance Table --}}
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Check In (BST)</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Check Out (BST)</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Working Hours</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Duty</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        
                        @forelse ($attendances as $record)
                            @php
                                $checkIn = $record->check_in_at->setTimezone('Asia/Dhaka');
                                $checkOut = $record->check_out_at ? $record->check_out_at->setTimezone('Asia/Dhaka') : null;
                                
                                $workingHours = 'N/A';
                                $isLate = ($checkIn->hour >= 9 && $checkIn->minute > 0); // Example late check: After 9:00 AM
                                $statusClass = $isLate ? 'bg-yellow-100 text-yellow-700 border-yellow-200' : 'bg-green-100 text-green-700 border-green-200';
                                $statusText = $isLate ? 'Late' : 'Present';

                                if ($checkOut) {
                                    $interval = $checkIn->diff($checkOut);
                                    $workingHours = $interval->format('%h hrs %i mins');
                                } else {
                                    $statusText = 'In Progress';
                                    $statusClass = 'bg-blue-100 text-blue-700 border-blue-200';
                                }
                            @endphp
                            
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900">{{ $checkIn->format('d M, Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $checkIn->format('l') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <span class="{{ $isLate ? 'text-red-500 font-medium' : '' }}">{{ $checkIn->format('h:i A') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $checkOut ? $checkOut->format('h:i A') : '— —' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $workingHours }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }} border">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 hover:text-indigo-900 cursor-pointer">
                                    {{ $record->duty_assignment_id ? 'View Details' : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">No attendance records found for {{ $months[$currentMonth] }} {{ $currentYear }}.</td>
                            </tr>
                        @endforelse
                        
                        {{-- Placeholder for missing days (Outside of loop) --}}
                        {{-- NOTE: Calculating truly absent days dynamically requires comparing shifts/holidays, complex for this method. --}}

                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Placeholder --}}
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <p class="text-sm text-gray-700">Displaying {{ $attendances->count() }} records.</p>
                {{-- If you implement pagination, replace the above line with: {{ $attendances->links() }} --}}
            </div>

        </div>
    </div>
</div>
@endsection