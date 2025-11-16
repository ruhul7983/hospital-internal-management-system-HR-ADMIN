@extends('admin.layouts.main')
@section('title', 'Salary Head Configuration')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Salary Head Configuration</h1>

        <a href="{{ route('admin.salary.head.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
            Add Salary Head
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm">
                    <th class="px-5 py-3 font-medium">Name</th>
                    <th class="px-5 py-3 font-medium">Type</th>
                    <th class="px-5 py-3 font-medium">Calculation Type</th>
                    <th class="px-5 py-3 font-medium">Multiplier/Percentage</th>
                    <th class="px-5 py-3 font-medium">Set as Basic</th>
                    <th class="px-5 py-3 font-medium">Editable per User</th>
                    <th class="px-5 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-800 text-sm">

                {{-- Row Example --}}
                <tr class="border-t">
                    <td class="px-5 py-3">Basic Salary</td>
                    <td class="px-5 py-3">Earning</td>
                    <td class="px-5 py-3">Fixed</td>
                    <td class="px-5 py-3">10000</td>
                    <td class="px-5 py-3"><input type="checkbox" checked></td>
                    <td class="px-5 py-3"><input type="checkbox"></td>

                    <td class="px-5 py-3">

                        <div class="flex justify-end items-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('admin.salary.head.edit', 1) }}"
                                class="px-2 py-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                edit
                            </a>

                            {{-- Delete --}}
                            <form>
                                <button type="button"
                                    class="px-2 py-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                    delete
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>

                {{-- Duplicate Example Rows Below --}}
                <tr class="border-t">
                    <td class="px-5 py-3">House Rent Allowance</td>
                    <td class="px-5 py-3">Allowance</td>
                    <td class="px-5 py-3">Percentage</td>
                    <td class="px-5 py-3">40%</td>
                    <td class="px-5 py-3"><input type="checkbox"></td>
                    <td class="px-5 py-3"><input type="checkbox" checked></td>
                    <td class="px-5 py-3">
                        <div class="flex justify-end items-center gap-2">
                            <a href="{{ route('admin.salary.head.edit', 2) }}"
                                class="px-2 py-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">edit</a>
                            <button type="button"
                                class="px-2 py-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">delete</button>
                        </div>
                    </td>
                </tr>

           

            </tbody>
        </table>
    </div>
</div>
@endsection
