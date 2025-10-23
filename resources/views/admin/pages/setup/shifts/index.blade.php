@extends('admin.layouts.main')
@section('content')
    <div>
        <div class="flex items-center justify-between ">
            <div>
                <h1 class="text-2xl font-bold">Works Shifts</h1>
                <p>Create and manage your shifts</p>
            </div>
            <div>
                <a href="{{ route('admin.pages.setup.shifts.create') }}"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Add New Shift</a>
            </div>
        </div>
        <div>
            <form action="" method="post" class="mt-4 flex items-center gap-2">
                @csrf
                <select name="actor" id="filter" class="border border-gray-300 rounded
                px-3 py-1">
                    <option value="">All</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Nurse">Nurse</option>
                    <option value="Staff">Staff</option>
                </select>
                <button type="submit" class="bg-emerald-600 px-4 rounded-xs py-1 text-white font-semibold">Filter</button>
            </form>
        </div>
        <div>
            <!-- Container -->
            <div class="mt-10">
                <!-- Card -->
                <div class="overflow-hidden border border-gray-200 shadow-sm rounded-2xl">
                    <!-- Responsive scroll -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Shift Name
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Start Time
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        End Time
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Actor
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Break Times
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                <!-- Row 1 -->
                                <tr class="hover:bg-gray-50" data-shift-id="1">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">Morning A</div>
                                        <div class="text-xs text-gray-500">Weekday coverage</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <time class="text-gray-800">08:00</time>
                                    </td>
                                    <td class="px-4 py-3">
                                        <time class="text-gray-800">16:00</time>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium border-blue-200 text-blue-700 bg-blue-50">Doctor</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">30
                                                mins</span>
                                        </div>
                                    </td>
                                    <!-- Actions -->
                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <!-- Edit -->
                                            <a href="{{ route('admin.pages.setup.shifts.edit', ['shift' => 1]) }}">
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-gray-200 px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                onclick="editShift(1)">
                                                <!-- pencil icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 0 1 2.828 2.828l-8.25 8.25a2 2 0 0 1-.878.505l-3.036.76a.75.75 0 0 1-.907-.907l.76-3.036a2 2 0 0 1 .505-.878l8.25-8.25zM12 5l3 3" />
                                                </svg>
                                                <span class="sr-only">Edit Morning A</span>
                                                <span>Edit</span>
                                            </button>
                                            </a>

                                            <!-- Delete -->
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                onclick="deleteShift(1, 'Morning A')">
                                                <!-- trash icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M9 3h6a1 1 0 0 1 1 1v1h4v2H4V5h4V4a1 1 0 0 1 1-1Zm-2 7h2v9H7v-9Zm4 0h2v9h-2v-9Zm4 0h2v9h-2v-9Z" />
                                                </svg>
                                                <span class="sr-only">Delete Morning A</span>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-gray-50" data-shift-id="2">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">Evening B</div>
                                        <div class="text-xs text-gray-500">ER front desk</div>
                                    </td>
                                    <td class="px-4 py-3"><time class="text-gray-800">16:00</time></td>
                                    <td class="px-4 py-3"><time class="text-gray-800">00:00</time></td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium border-emerald-200 text-emerald-700 bg-emerald-50">Nurse</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">30
                                                mins</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-gray-200 px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                onclick="editShift(2)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 0 1 2.828 2.828l-8.25 8.25a2 2 0 0 1-.878.505l-3.036.76a.75.75 0 0 1-.907-.907l.76-3.036a2 2 0 0 1 .505-.878l8.25-8.25zM12 5l3 3" />
                                                </svg>
                                                <span class="sr-only">Edit Evening B</span>
                                                <span>Edit</span>
                                            </button>
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                onclick="deleteShift(2, 'Evening B')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M9 3h6a1 1 0 0 1 1 1v1h4v2H4V5h4V4a1 1 0 0 1 1-1Zm-2 7h2v9H7v-9Zm4 0h2v9h-2v-9Zm4 0h2v9h-2v-9Z" />
                                                </svg>
                                                <span class="sr-only">Delete Evening B</span>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-gray-50" data-shift-id="3">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">Night C</div>
                                        <div class="text-xs text-gray-500">Inpatient rounds</div>
                                    </td>
                                    <td class="px-4 py-3"><time class="text-gray-800">00:00</time></td>
                                    <td class="px-4 py-3"><time class="text-gray-800">08:00</time></td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium border-amber-200 text-amber-700 bg-amber-50">Staff</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">30
                                                mins</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-gray-200 px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                onclick="editShift(3)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 0 1 2.828 2.828l-8.25 8.25a2 2 0 0 1-.878.505l-3.036.76a.75.75 0 0 1-.907-.907l.76-3.036a2 2 0 0 1 .505-.878l8.25-8.25zM12 5l3 3" />
                                                </svg>
                                                <span class="sr-only">Edit Night C</span>
                                                <span>Edit</span>
                                            </button>
                                            <button type="button"
                                                class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                onclick="deleteShift(3, 'Night C')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M9 3h6a1 1 0 0 1 1 1v1h4v2H4V5h4V4a1 1 0 0 1 1-1Zm-2 7h2v9H7v-9Zm4 0h2v9h-2v-9Zm4 0h2v9h-2v-9Z" />
                                                </svg>
                                                <span class="sr-only">Delete Night C</span>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                            <!-- Optional footer -->
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-xs text-gray-500">
                                        * Break times are indicative and may vary by department.
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
