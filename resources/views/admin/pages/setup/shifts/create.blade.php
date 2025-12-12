@extends('admin.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Create Shift</h1>
    <p class="text-sm text-gray-500">Add a new shift to the schedule.</p>
  </div>

  <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
    <form method="POST" action="{{ route('admin.pages.setup.shifts.store') }}" class="p-6 space-y-6">
      @csrf

      {{-- Shift Name --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Shift Name</label>
        <input
          id="name"
          name="name"
          type="text"
          class="mt-1 block py-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
          placeholder="e.g., Morning A"
          value="{{ old('name') }}"
          required
        />
        @error('name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Times --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
          <input
            id="start_time"
            name="start_time"
            type="time"
            class="mt-1 block py-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('start_time') border-red-500 @enderror"
            value="{{ old('start_time') }}"
            required
          />
          @error('start_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
          <input
            id="end_time"
            name="end_time"
            type="time"
            class="mt-1 block py-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('end_time') border-red-500 @enderror"
            value="{{ old('end_time') }}"
            required
          />
          @error('end_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Actor --}}
      <div>
        <label for="actor" class="block text-sm font-medium text-gray-700">Actor</label>
        <select
          id="actor"
          name="actor"
          class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('actor') border-red-500 @enderror"
          required
        >
          @php
            $actorOld = old('actor');
          @endphp
          <option value="" disabled {{ $actorOld ? '' : 'selected' }}>Select role</option>
          <option value="Doctor" {{ $actorOld === 'Doctor' ? 'selected' : '' }}>Doctor</option>
          <option value="Nurse" {{ $actorOld === 'Nurse' ? 'selected' : '' }}>Nurse</option>
          <option value="Staff" {{ $actorOld === 'Staff' ? 'selected' : '' }}>Staff</option>
        </select>
        @error('actor')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Break Times (minutes) --}}
      <div>
        <label for="break_minutes" class="block text-sm font-medium text-gray-700">Break Time (minutes)</label>
        <input
          id="break_minutes"
          name="break_minutes"
          type="number"
          min="0"
          step="5"
          class="mt-1 block py-1 w-40 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('break_minutes') border-red-500 @enderror"
          placeholder="e.g., 30"
          value="{{ old('break_minutes', 30) }}"
        />
        @error('break_minutes')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <p class="mt-1 text-xs text-gray-500">For multiple breaks, store the total minutes.</p>
      </div>

      {{-- Cross Mid Night Shifts --}}
      <div class="pt-2">
        <label class="inline-flex items-center gap-3">
          <input
            type="checkbox"
            name="crosses_midnight"
            value="1"
            class="rounded py-1 border-gray-300 text-blue-600 focus:ring-blue-500"
            @checked(old('crosses_midnight'))
          />
          <span class="text-sm font-medium text-gray-800">Cross Mid Night Shifts</span>
        </label>
        <p class="mt-1 text-xs text-gray-500">
          Check this if the shift continues past midnight (e.g., 20:00 → 04:00).
        </p>
        @error('crosses_midnight')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3 pt-4">
        <a href="{{ route('admin.pages.setup.shifts.index') }}"
           class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
          Cancel
        </a>
        <button type="submit"
                class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
          Save Shift
        </button>
      </div>
    </form>
  </div>

  {{-- Global form errors --}}
  @if ($errors->any())
    <div class="mt-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
      <strong>There were some problems with your input.</strong>
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
@endsection