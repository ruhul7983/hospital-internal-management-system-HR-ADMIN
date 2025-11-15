@extends('admin.layouts.main')

@section('content')
<div class="px-6 py-8">
    <div class="mx-auto max-w-7xl">
        {{-- Header + CTA --}}
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold tracking-tight text-gray-900">Employees</h1>
            <a href="{{ route('admin.pages.employees.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600/50">
                {{-- plus icon --}}
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Add Employee
            </a>
        </div>

        {{-- Filters --}}
        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
            <div class="relative inline-flex w-40">
                <select class="w-full appearance-none rounded-md border border-gray-300 bg-white px-3 py-2 pr-9 text-sm text-gray-700 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                    <option>Role</option>
                    <option>Nurse</option>
                    <option>Doctor</option>
                    <option>Technician</option>
                </select>
                <svg class="pointer-events-none absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>
            </div>
            <div class="relative inline-flex w-48">
                <select class="w-full appearance-none rounded-md border border-gray-300 bg-white px-3 py-2 pr-9 text-sm text-gray-700 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                    <option>Department</option>
                    <option>Cardiology</option>
                    <option>Emergency</option>
                    <option>Radiology</option>
                </select>
                <svg class="pointer-events-none absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>
            </div>
        </div>

        {{-- Table --}}
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Department</th>
                    <th class="px-6 py-3">Specialty</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white text-sm text-gray-700">
                @php
                    // Example fallback data (remove when passing $employees from controller)
                    $employees = $employees ?? [
                        ['id'=>1,'name'=>'Sophia Carter','email'=>'sophia.carter@example.com','role'=>'Nurse','department'=>'Cardiology','specialty'=>'Cardiac Care','active'=>true],
                        ['id'=>2,'name'=>'Ethan Bennett','email'=>'ethan.bennett@example.com','role'=>'Doctor','department'=>'Emergency','specialty'=>'Trauma','active'=>true],
                        ['id'=>3,'name'=>'Olivia Hayes','email'=>'olivia.hayes@example.com','role'=>'Technician','department'=>'Radiology','specialty'=>'Imaging','active'=>true],
                        ['id'=>4,'name'=>'Liam Foster','email'=>'liam.foster@example.com','role'=>'Therapist','department'=>'Rehabilitation','specialty'=>'Physical Therapy','active'=>false],
                        ['id'=>5,'name'=>'Ava Coleman','email'=>'ava.coleman@example.com','role'=>'Pharmacist','department'=>'Pharmacy','specialty'=>'Medication Management','active'=>true],
                        ['id'=>6,'name'=>'Noah Brooks','email'=>'noah.brooks@example.com','role'=>'Assistant','department'=>'Administration','specialty'=>'Patient Support','active'=>true],
                        ['id'=>7,'name'=>'Isabella Reed','email'=>'isabella.reed@example.com','role'=>'Specialist','department'=>'Oncology','specialty'=>'Cancer Treatment','active'=>false],
                        ['id'=>8,'name'=>'Jackson Pierce','email'=>'jackson.pierce@example.com','role'=>'Coordinator','department'=>'Operations','specialty'=>'Logistics','active'=>true],
                    ];
                @endphp

                @foreach ($employees as $emp)
                    <tr class="hover:bg-gray-50/80">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $emp['name'] }}</td>
                        <td class="px-6 py-4">
                            <a href="mailto:{{ $emp['email'] }}" class="text-blue-600 hover:underline">{{ $emp['email'] }}</a>
                        </td>
                        <td class="px-6 py-4">{{ $emp['role'] }}</td>
                        <td class="px-6 py-4">{{ $emp['department'] }}</td>
                        <td class="px-6 py-4">{{ $emp['specialty'] }}</td>
                        <td class="px-6 py-4">
                            @if ($emp['active'])
                                <span class="inline-flex items-center gap-2 rounded-full bg-green-50 px-3 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-200">
                                    <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-200">
                                    <span class="inline-block h-2 w-2 rounded-full bg-red-500"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                {{-- Active Toggle --}}
                                <form method="POST" >
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            title="Toggle Active"
                                            class="relative inline-flex h-6 w-11 items-center rounded-full transition
                                                   {{ $emp['active'] ? 'bg-blue-600' : 'bg-gray-300' }}">
                                        <span class="sr-only">Toggle Active</span>
                                        <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow
                                                     transition {{ $emp['active'] ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                    </button>
                                </form>

                                {{-- Edit --}}
                                <a href={{ route("admin.pages.employees.edit") }}
                                   class="inline-flex items-center rounded-md border border-gray-200 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:border-blue-600 hover:text-blue-600">
                                    <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5h2m-8 14h14M16.5 3.5 20.5 7.5 8 20H4v-4L16.5 3.5z"/>
                                    </svg>
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form method="POST" action="#"
                                      onsubmit="return confirm('Delete this employee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 shadow-sm hover:bg-red-50">
                                        <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a2 2 0 012-2h2a2 2 0 012 2v2"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
