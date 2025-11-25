@extends('user.layouts.main')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

        {{-- Check-in --}}
        <div class="rounded-xl bg-white ring-1 ring-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Attendance</h2>
            <form action="" method="post">
                @csrf
                <button
                    type="submit"
                    class="h-28 w-28 sm:h-32 sm:w-32 rounded-full bg-emerald-600 text-white font-semibold
                           hover:bg-emerald-700 focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300
                           active:scale-95 transition"
                    
                >
                    Check in
                </button>
            </form>
        </div>

        {{-- Upcoming Shifts --}}
        <div class="rounded-xl bg-white ring-1 ring-slate-200 shadow-sm p-6">
            <h1 class="text-xl sm:text-2xl font-semibold text-slate-900">Upcoming Shifts</h1>

            <div class="mt-4 p-4 rounded-lg ring-1 ring-slate-200 bg-slate-50">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-hospital text-slate-700"></i>
                    <h3 class="text-base sm:text-lg font-semibold text-slate-900">Emergency Ward</h3>
                </div>

                <div class="mt-3 space-y-2 text-sm sm:text-base">
                    <div class="flex items-center gap-2 text-slate-600">
                        <i class="fa-solid fa-calendar-days text-slate-500"></i>
                        <p>22-OCT-2025</p>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600">
                        <i class="fa-solid fa-clock text-slate-500"></i>
                        <p>09:00 AM - 05:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
