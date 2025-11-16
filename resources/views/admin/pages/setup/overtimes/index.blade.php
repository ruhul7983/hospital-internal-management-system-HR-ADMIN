@extends('admin.layouts.main')

@section('title', 'Overtimes')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
  {{-- Header --}}
  <div class="flex items-center justify-between py-6">
    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Overtime Policies</h1>

    <a
      href="{{ route('admin.pages.setup.overtimes.create') }}"
      class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      New Policy
    </a>
  </div>

  {{-- Table --}}
  <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
    <table class="min-w-full">
      <thead class="bg-gray-50">
        <tr class="text-left text-xs font-medium uppercase tracking-wider text-gray-500">
          <th class="px-6 py-4">Policy Name</th>
          <th class="px-6 py-4">Actor Type</th>
          <th class="px-6 py-4">Weekday</th>
          <th class="px-6 py-4">Weekend</th>
          <th class="px-6 py-4">Holiday</th>
          <th class="px-6 py-4">Daily Cap (min)</th>
          <th class="px-6 py-4">Monthly Cap (min)</th>
          <th class="px-6 py-4">Rounding (min)</th>
          <th class="px-6 py-4">Approval</th>
          <th class="px-6 py-4 text-center">Actions</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100 text-sm">

        {{-- Row Example --}}
        <tr class="hover:bg-gray-50/60">
          <td class="px-6 py-4 font-medium text-gray-900">Standard Doctor Policy</td>
          <td class="px-6 py-4">
            <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
              Doctor
            </span>
          </td>
          <td class="px-6 py-4 text-gray-700">1.5x</td>
          <td class="px-6 py-4 text-gray-700">2.0x</td>
          <td class="px-6 py-4 text-gray-700">2.5x</td>
          <td class="px-6 py-4 tabular-nums text-gray-700">60</td>
          <td class="px-6 py-4 tabular-nums text-gray-700">240</td>
          <td class="px-6 py-4 tabular-nums text-gray-700">15</td>
          <td class="px-6 py-4">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-50 ring-1 ring-inset ring-green-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 13 4 4L19 7"/>
              </svg>
            </span>
          </td>
          <td class="px-6 py-4 text-center">
            <div class="flex justify-center gap-2">
              <a href="#" class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 hover:bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l3.536 3.536M3 17h4l10-10-4-4L3 13v4z"/>
                </svg>
                Edit
              </a>
              <button type="button" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1 text-xs font-medium text-red-600 hover:bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Delete
              </button>
            </div>
          </td>
        </tr>

        {{-- Repeat other rows as needed with same button layout --}}
      </tbody>
    </table>
  </div>
</div>
@endsection
