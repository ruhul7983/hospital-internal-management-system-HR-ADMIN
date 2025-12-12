@extends('admin.layouts.main')

@section('content')
<div class="px-6 py-8">
    <div class="mx-auto max-w-7xl">
        {{-- Header + CTA --}}
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold tracking-tight text-gray-900">Employees</h1>
            <a href="{{ route('admin.pages.employees.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600/50">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Employee
            </a>
        </div>
        
        @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
        @endif

        {{-- Filters (Simplified to use GET) --}}
        <form method="GET" action="{{ route('admin.pages.employees.index') }}" class="mt-6 flex flex-col gap-3 sm:flex-row">
            @csrf
            
            <div class="relative inline-flex w-40">
                <select name="role" class="w-full appearance-none rounded-md border border-gray-300 bg-white px-3 py-2 pr-9 text-sm text-gray-700 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                    <option value="">All Roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected(request('role') == $role)>{{ $role }}</option>
                    @endforeach
                </select>
                <svg class="pointer-events-none absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>
            </div>
            
            <div class="relative inline-flex w-48">
                <select name="department_id" class="w-full appearance-none rounded-md border border-gray-300 bg-white px-3 py-2 pr-9 text-sm text-gray-700 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                    <option value="">All Departments</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" @selected(request('department_id') == $dept->id)>{{ $dept->name }}</option>
                    @endforeach
                </select>
                <svg class="pointer-events-none absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>
            </div>
            <button type="submit" class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">Filter</button>
        </form>

        {{-- Table --}}
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
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
                    @forelse ($employees as $employee)
                        <tr class="hover:bg-gray-50/80">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $employee->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="mailto:{{ $employee->user->email }}" class="text-blue-600 hover:underline">{{ $employee->user->email }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $employee->user->role }}</td>
                            <td class="px-6 py-4">{{ $employee->department->name ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $employee->specialty ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    // Assuming the 'is_active' status is managed on the User model
                                    $isActive = $employee->user->is_active ?? false;
                                @endphp
                                @if ($isActive)
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
                                    <form method="POST" action="{{ route('admin.pages.employees.toggleStatus', $employee->user->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                title="Toggle Active"
                                                class="relative inline-flex h-6 w-11 items-center rounded-full transition {{ $isActive ? 'bg-blue-600' : 'bg-gray-300' }}">
                                            <span class="sr-only">Toggle Active</span>
                                            <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition {{ $isActive ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                        </button>
                                    </form>

                                    {{-- Edit --}}
                                    <a href="{{ route("admin.pages.employees.edit", $employee->id) }}"
                                       class="inline-flex items-center rounded-md border border-gray-200 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:border-blue-600 hover:text-blue-600">
                                        <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-8 14h14M16.5 3.5 20.5 7.5 8 20H4v-4L16.5 3.5z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.pages.employees.delete', $employee->id) }}"
                                          onsubmit="return confirm('WARNING: Deleting {{ $employee->user->name }} will remove their profile and login access. Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center rounded-md border border-red-200 bg-white px-2.5 py-1.5 text-xs font-medium text-red-600 shadow-sm hover:bg-red-50">
                                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a2 2 0 012-2h2a2 2 0 012 2v2"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                No employees found for this hospital.
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