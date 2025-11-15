{{-- resources/views/admin/duty-management/index.blade.php --}}
@extends('admin.layouts.main')

@section('title', 'Duty Management')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
  <div class="py-6">
    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Duty Management</h1>
    <p class="mt-1 text-sm text-gray-500">Manage duty assignments for doctors and nurses.</p>
  </div>

  <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
{{-- Left: Date Picker + Filters (UI-only) --}}
<aside class="space-y-6 lg:col-span-1">
  {{-- Date Picker Card (replaces calendar) --}}
  <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
    <label for="duty-date" class="mb-2 block text-sm font-medium text-gray-700">Pick a date</label>
    <div class="relative">
      <input
        id="duty-date"
        name="duty_date"
        type="date"
        class="w-full rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 text-gray-900 shadow-sm
               focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
        value=""
      >
      
    </div>
  </div>

  {{-- Actor Type --}}
  <div class="space-y-2">
    <label class="text-sm font-medium text-gray-700">Actor Type</label>
    <div class="relative">
      <select
        class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 text-gray-900 shadow-sm
               focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <option>Doctor</option>
        <option>Nurse</option>
      </select>
      <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
           viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
              clip-rule="evenodd"/>
      </svg>
    </div>
  </div>

  {{-- Bulk apply until + save (mobile mirror) --}}
  <div class="flex items-center gap-3 lg:hidden">
    <button type="button"
      class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200">
      Apply same shift until
    </button>
    <div class="relative flex-1">
      <input
        type="date"
        placeholder="mm/dd/yyyy"
        class="w-full rounded-xl border border-gray-200 px-3.5 py-2.5 pr-10 shadow-sm
               focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
      <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
           viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
      </svg>
    </div>
  </div>
</aside>



    {{-- Right: Assignment table --}}
    <section class="lg:col-span-2">
      {{-- Filter chips --}}
      <div class="mb-3 flex items-center gap-2 text-sm">
        <span class="text-gray-600">Filter by:</span>
        <button type="button" class="rounded-full bg-blue-100 px-3 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-200">Assigned</button>
        <button type="button" class="rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-700 ring-1 ring-inset ring-gray-200 hover:bg-gray-200">Not Assigned</button>
        <button type="button" class="rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-700 ring-1 ring-inset ring-gray-200 hover:bg-gray-200">On Leave</button>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full">
          <thead class="bg-gray-50">
            <tr class="text-left text-xs font-medium uppercase tracking-wider text-gray-500">
              <th class="px-6 py-4">Name</th>
              <th class="px-6 py-4">Department</th>
              <th class="px-6 py-4">Shift</th>
              <th class="px-6 py-4 text-right">
                <label class="inline-flex items-center gap-2">
                  <span class="text-[11px] font-medium text-gray-500">All</span>
                  <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                </label>
              </th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100 text-sm">
            {{-- Row 1 --}}
            <tr class="hover:bg-gray-50/60">
              <td class="px-6 py-4 text-gray-800">Dr. Amelia Chen</td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-56 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option selected>Cardiology</option>
                    <option>Neurology</option>
                    <option>Pediatrics</option>
                    <option>Oncology</option>
                    <option>Emergency Medicine</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option selected>Day Shift</option>
                    <option>Night Shift</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4 text-right">
                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
              </td>
            </tr>

            {{-- Row 2 --}}
            <tr class="hover:bg-gray-50/60">
              <td class="px-6 py-4 text-gray-800">Dr. Ethan Ramirez</td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-56 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Cardiology</option><option selected>Neurology</option><option>Pediatrics</option><option>Oncology</option><option>Emergency Medicine</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Day Shift</option><option selected>Night Shift</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4 text-right">
                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
              </td>
            </tr>

            {{-- Row 3 --}}
            <tr class="hover:bg-gray-50/60">
              <td class="px-6 py-4 text-gray-800">Dr. Olivia Bennett</td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-56 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Cardiology</option><option>Neurology</option><option selected>Pediatrics</option><option>Oncology</option><option>Emergency Medicine</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option selected>Day Shift</option><option>Night Shift</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4 text-right">
                <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
              </td>
            </tr>

            {{-- Row 4 --}}
            <tr class="hover:bg-gray-50/60">
              <td class="px-6 py-4 text-gray-800">Dr. Noah Carter</td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-56 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Cardiology</option><option>Neurology</option><option>Pediatrics</option><option selected>Oncology</option><option>Emergency Medicine</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Day Shift</option><option selected>Night Shift</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4 text-right">
                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
              </td>
            </tr>

            {{-- Row 5 --}}
            <tr class="hover:bg-gray-50/60">
              <td class="px-6 py-4 text-gray-800">Dr. Sophia Davis</td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-56 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Cardiology</option><option>Neurology</option><option>Pediatrics</option><option>Oncology</option><option selected>Emergency Medicine</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="relative">
                  <select class="w-48 appearance-none rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option selected>Day Shift</option><option>Night Shift</option>
                  </select>
                  <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
                </div>
              </td>
              <td class="px-6 py-4 text-right">
                <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      {{-- Bulk apply + date + save --}}
      <div class="mt-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button type="button" class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200">Apply same shift until</button>
          <div class="relative">
            <input type="text" placeholder="mm/dd/yyyy" class="w-40 rounded-xl border border-gray-200 px-3.5 py-2.5 pr-10 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
            <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/></svg>
          </div>
        </div>

        <button type="button" class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
          Bulk Save
        </button>
      </div>
    </section>
  </div>
</div>
@endsection
