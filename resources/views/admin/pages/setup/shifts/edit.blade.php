@extends('admin.layouts.main')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold">Edit Shift</h1>
    <p class="text-sm text-gray-500">Update the details for this shift.</p>
  </div>

  <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
    <form method="POST"  class="p-6 space-y-6">
      @csrf
      @method('PUT')

      {{-- Shift Name --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Shift Name</label>
        <input
          id="name"
          name="name"
          type="text"
          class="mt-1 block w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
          placeholder="e.g., Morning A"
          value="{{ old('name', $shift->name) }}"
          required
        />
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      {{-- Times --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
          <input
            id="start_time"
            name="start_time"
            type="time"
            class="mt-1 block w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
            value="{{ old('start_time', \Illuminate\Support\Str::of($shift->start_time)->substr(0,5)) }}"
            required
          />
          @error('start_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
          <input
            id="end_time"
            name="end_time"
            type="time"
            class="mt-1 block w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
            value="{{ old('end_time', \Illuminate\Support\Str::of($shift->end_time)->substr(0,5)) }}"
            required
          />
          @error('end_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
      </div>

      {{-- Actor --}}
      <div>
        <label for="actor" class="block text-sm font-medium text-gray-700">Actor</label>
        @php $actorOld = old('actor', $shift->actor); @endphp
        <select
          id="actor"
          name="actor"
          class="mt-1 block w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
          required
        >
          <option value="" disabled {{ $actorOld ? '' : 'selected' }}>Select role</option>
          <option value="Doctor" {{ $actorOld === 'Doctor' ? 'selected' : '' }}>Doctor</option>
          <option value="Nurse"  {{ $actorOld === 'Nurse'  ? 'selected' : '' }}>Nurse</option>
          <option value="Staff"  {{ $actorOld === 'Staff'  ? 'selected' : '' }}>Staff</option>
        </select>
        @error('actor') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      {{-- Break Time (minutes) --}}
      <div>
        <label for="break_minutes" class="block text-sm font-medium text-gray-700">Break Time (minutes)</label>
        <input
          id="break_minutes"
          name="break_minutes"
          type="number"
          min="0"
          step="5"
          class="mt-1 block w-40 rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
          placeholder="e.g., 30"
          value="{{ old('break_minutes', $shift->break_minutes ?? 30) }}"
        />
        @error('break_minutes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        <p class="mt-1 text-xs text-gray-500">Use total minutes, or extend your model to store multiple ranges.</p>
      </div>

      {{-- Cross Mid Night Shifts --}}
      <div class="pt-2">
        <label class="inline-flex items-center gap-3">
          <input
            type="checkbox"
            name="crosses_midnight"
            value="1"
            class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
            @checked(old('crosses_midnight', (bool) ($shift->crosses_midnight ?? false)))
          />
          <span class="text-sm font-medium text-gray-800">Cross Mid Night Shifts</span>
        </label>
        <p class="mt-1 text-xs text-gray-500">Check if the shift passes midnight (e.g., 20:00 → 04:00).</p>
        @error('crosses_midnight') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-between pt-4">
        <a href="#"
           class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
          Back
        </a>

        <div class="flex items-center gap-3">
          {{-- Optional: inline delete (guard with policy/permission) --}}
          {{-- 
          <form method="POST" action="{{ route('shifts.destroy', $shift) }}" onsubmit="return confirm('Delete this shift?');">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="inline-flex items-center rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-50">
              Delete
            </button>
          </form>
          --}}
          <button type="submit"
                  class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            Update Shift
          </button>
        </div>
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
