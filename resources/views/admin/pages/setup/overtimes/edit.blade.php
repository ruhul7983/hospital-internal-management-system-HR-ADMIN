@extends('admin.layouts.main')

@section('title', 'Edit Overtime Policy')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
  <h1 class="py-6 text-2xl font-semibold tracking-tight text-gray-900">Edit Overtime Policy</h1>

  <form action="#" method="post" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    {{-- Left: Form fields (prefilled example values) --}}
    <div class="lg:col-span-2 space-y-6">
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Name</label>
          <input type="text" value="Senior Nurse Policy"
                 class="w-full rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Actor Type</label>
          <div class="relative">
            <select class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 text-gray-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
              <option>Doctor</option>
              <option selected>Nurse</option>
            </select>
            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
            </svg>
          </div>
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Weekday Multiplier</label>
          <input type="text" value="1.25" class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Weekend Multiplier</label>
          <input type="text" value="1.75" class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Holiday Multiplier</label>
          <input type="text" value="2.25" class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Daily Cap (minutes)</label>
          <input type="text" value="90" class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Monthly Cap (minutes)</label>
          <input type="text" value="360" class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-gray-700">Rounding (minutes)</label>
          <input type="text" value="30" class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
      </div>

      {{-- Toggle (checked) --}}
      <div class="rounded-xl border border-gray-200 bg-white p-3.5 shadow-sm">
        <div class="flex items-center justify-between">
          <span class="text-sm font-medium text-gray-700">Requires Approval</span>
          <label class="relative inline-flex cursor-pointer items-center">
            <input type="checkbox" checked class="peer sr-only">
            <span class="h-6 w-11 rounded-full bg-gray-200 transition peer-checked:bg-blue-600"></span>
            <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:translate-x-5"></span>
          </label>
        </div>
      </div>

      {{-- Actions --}}
      <div class="flex items-center gap-3">
        <a href="#" class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Cancel</a>
        <button type="submit" class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
          Save Changes
        </button>
      </div>
    </div>

    {{-- Right: Preview --}}
    <aside class="space-y-4">
      <h2 class="text-lg font-semibold text-gray-900">Policy Preview</h2>

      <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Weekday Hours</label>
        <input type="text" value="3" class="w-full rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
      </div>

      <div class="h-72 rounded-xl border border-gray-200 bg-white shadow-sm"></div>
    </aside>
  </form>
</div>
@endsection
