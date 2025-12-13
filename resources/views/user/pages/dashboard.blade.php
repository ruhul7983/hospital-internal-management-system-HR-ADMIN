@extends('user.layouts.main')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

        {{-- Attendance / Check-in --}}
        <div class="rounded-xl bg-white ring-1 ring-slate-200 shadow-sm p-6 flex flex-col items-center">
            <h2 class="text-lg font-semibold text-slate-900 mb-6 w-full text-center">Your Attendance Today</h2>
            
            <form action="{{ route('user.attendance.checkinout') }}" method="post" class="text-center">
                @csrf
                
                @if ($hasCheckedIn)
                    {{-- Check Out Button (Currently Checked In) --}}
                    <button
                        type="submit"
                        class="h-32 w-32 rounded-full bg-red-600 text-white font-semibold text-xl
                               hover:bg-red-700 focus:outline-none focus-visible:ring-4 focus-visible:ring-red-300
                               active:scale-95 transition"
                    >
                        Check Out
                    </button>
                    <p class="mt-3 text-sm text-slate-600">
                        Checked in at: {{ $currentAttendance->check_in_at->format('h:i:s A') }}
                    </p>

                @elseif ($canCheckIn)
                    {{-- Check In Button (Enabled only if duty time is running) --}}
                    <button
                        type="submit"
                        class="h-32 w-32 rounded-full bg-emerald-600 text-white font-semibold text-xl
                               hover:bg-emerald-700 focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300
                               active:scale-95 transition"
                        @disabled(!$canCheckIn)
                    >
                        Check In
                    </button>
                    <p class="mt-3 text-sm text-slate-600">
                        Status: Ready to Check In
                        @if($dutyTimeInfo)
                            <br><span class="text-xs text-green-600">Window: {{ $dutyTimeInfo['window_start'] }} to {{ $dutyTimeInfo['end'] }}</span>
                        @endif
                    </p>

                @else
                    {{-- Button is disabled or replaced if rules prevent check-in --}}
                    <div class="h-32 w-32 rounded-full bg-slate-200 text-slate-700 font-semibold text-base flex items-center justify-center p-3 text-center">
                        @if (!$todayDuty)
                            NO DUTY ASSIGNED
                        @elseif (!$isDutyTimeRunning)
                            WAIT FOR SHIFT
                        @else
                             DONE FOR TODAY
                        @endif
                    </div>
                    
                    @if ($currentAttendance && $currentAttendance->check_out_at)
                        <p class="mt-3 text-sm text-slate-600">
                            Checked out at: {{ $currentAttendance->check_out_at->format('h:i:s A') }}
                        </p>
                    @elseif ($todayDuty && $dutyTimeInfo)
                         <p class="mt-3 text-sm text-red-600">
                            Check-in allowed from: {{ $dutyTimeInfo['window_start'] }}
                        </p>
                        <p class="text-xs text-slate-500">
                            (Shift starts: {{ $dutyTimeInfo['start'] }})
                        </p>
                    @else
                        <p class="mt-3 text-sm text-slate-500">No duty assigned for today.</p>
                    @endif
                @endif
                
            </form>
        </div>

        {{-- Upcoming Shifts --}}
        <div class="rounded-xl bg-white ring-1 ring-slate-200 shadow-sm p-6">
            <h1 class="text-xl sm:text-2xl font-semibold text-slate-900">Upcoming Shifts</h1>

            <div class="mt-4 space-y-4">
                {{-- Display today's duty separately --}}
                @if ($todayDuty)
                    <h3 class="text-sm font-bold text-indigo-600 border-b border-indigo-200 pb-1 mb-2">TODAY'S DUTY</h3>
                    <div class="p-4 rounded-lg ring-2 ring-indigo-300 bg-indigo-50">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-hospital text-indigo-700"></i>
                            <h3 class="text-base sm:text-lg font-semibold text-indigo-900">
                                {{ $todayDuty->assignedDepartment->name ?? 'Unassigned Department' }}
                            </h3>
                        </div>
                        <div class="mt-3 space-y-2 text-sm sm:text-base">
                            <div class="flex items-center gap-2 text-slate-600">
                                <i class="fa-solid fa-clock text-slate-500"></i>
                                <p>{{ \Carbon\Carbon::parse($todayDuty->shift->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($todayDuty->shift->end_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <h3 class="text-sm font-bold text-gray-600 border-b border-gray-200 pb-1 mb-2">FUTURE SHIFTS</h3>
                @forelse ($upcomingDuties as $duty)
                    <div class="p-4 rounded-lg ring-1 ring-slate-200 bg-slate-50">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-hospital text-slate-700"></i>
                            <h3 class="text-base sm:text-lg font-semibold text-slate-900">
                                {{ $duty->assignedDepartment->name ?? 'Unassigned Department' }}
                            </h3>
                        </div>

                        <div class="mt-3 space-y-2 text-sm sm:text-base">
                            <div class="flex items-center gap-2 text-slate-600">
                                <i class="fa-solid fa-calendar-days text-slate-500"></i>
                                <p>{{ $duty->date->format('d-M-Y') }} ({{ $duty->date->diffForHumans() }})</p>
                            </div>
                            <div class="flex items-center gap-2 text-slate-600">
                                <i class="fa-solid fa-clock text-slate-500"></i>
                                <p>{{ \Carbon\Carbon::parse($duty->shift->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($duty->shift->end_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm italic">No upcoming shifts assigned.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection