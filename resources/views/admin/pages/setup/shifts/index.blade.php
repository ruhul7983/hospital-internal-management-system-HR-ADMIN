@extends('admin.layouts.main')
@section('content')
<div class="p-6">
    {{-- Header and Actions --}}
    <div class="flex items-center justify-between ">
        <div>
            <h1 class="text-2xl font-bold">Works Shifts</h1>
            <p>Create and manage shifts for your hospital.</p>
        </div>
        <div>
            <a href="{{ route('admin.pages.setup.shifts.create') }}"
                class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Add New Shift</a>
        </div>
    </div>

    {{-- Filter Form (Method GET for filtering) --}}
    <div class="mt-4">
        <form action="{{ route('admin.pages.setup.shifts.index') }}" method="GET" class="flex items-center gap-2">
            <select name="actor" id="filter" class="border border-gray-300 rounded px-3 py-1">
                <option value="">All Actors</option>
                <option value="Doctor" @selected(request('actor') == 'Doctor')>Doctor</option>
                <option value="Nurse" @selected(request('actor') == 'Nurse')>Nurse</option>
                <option value="Staff" @selected(request('actor') == 'Staff')>Staff</option>
            </select>
            <button type="submit" class="bg-emerald-600 px-4 rounded-lg py-1 text-white font-semibold hover:bg-emerald-700">Filter</button>
            @if (request('actor'))
                <a href="{{ route('admin.pages.setup.shifts.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Clear Filter</a>
            @endif
        </form>
    </div>

    @if (session('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="mt-10">
        {{-- Table Container --}}
        <div class="overflow-hidden border border-gray-200 shadow-sm rounded-2xl">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Shift Name</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Start Time</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">End Time</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Actor</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Break Times</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($shifts as $shift)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $shift->name }}</div>
                                    @if ($shift->crosses_midnight)
                                        <span class="text-xs text-indigo-500 font-medium">Crosses Midnight</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <time class="text-gray-800">{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</time>
                                </td>
                                <td class="px-4 py-3">
                                    <time class="text-gray-800">{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</time>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        // Dynamic coloring based on actor role
                                        $color = match ($shift->actor) {
                                            'Doctor' => 'blue',
                                            'Nurse' => 'emerald',
                                            'Staff' => 'amber',
                                            default => 'gray',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium border-{{$color}}-200 text-{{$color}}-700 bg-{{$color}}-50">
                                        {{ $shift->actor }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">{{ $shift->break_minutes }} mins</span>
                                    </div>
                                </td>
                                
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.pages.setup.shifts.edit', $shift->id) }}">
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-gray-200 px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M13.586 3.586a2 2 0 0 1 2.828 2.828l-8.25 8.25a2 2 0 0 1-.878.505l-3.036.76a.75.75 0 0 1-.907-.907l.76-3.036a2 2 0 0 1 .505-.878l8.25-8.25zM12 5l3 3" />
                                                </svg>
                                                <span>Edit</span>
                                            </button>
                                        </a>

                                        {{-- Delete Form --}}
                                        <form action="{{ route('admin.pages.setup.shifts.delete', $shift->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the shift: {{ $shift->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                    <path d="M9 3h6a1 1 0 0 1 1 1v1h4v2H4V5h4V4a1 1 0 0 1 1-1Zm-2 7h2v9H7v-9Zm4 0h2v9h-2v-9Zm4 0h2v9h-2v-9Z" />
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-gray-500">
                                    No shifts have been defined for your hospital yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection