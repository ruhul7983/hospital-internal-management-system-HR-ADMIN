@extends('admin.layouts.main')
@section('title', 'Department')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Departments</h1>
        <a href={{ route("admin.pages.setup.departments.create") }} class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center gap-2">
            <span class="text-lg font-bold">+</span>
            Add Department
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600">Department Name</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Description</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Actor Types</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Status</th>
                    <th class="px-4 py-3 font-medium text-gray-600 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-medium text-gray-700">Cardiology</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Specializes in heart-related conditions and treatments.</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Doctor, Nurse</td>
                    <td class="px-4 py-3"><span class="text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full">Active</span></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href={{ route("admin.pages.setup.departments.edit") }} class="text-blue-600 hover:underline">Edit</a>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-medium text-gray-700">Neurology</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Focuses on disorders of the nervous system.</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Doctor, Nurse</td>
                    <td class="px-4 py-3"><span class="text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full">Active</span></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <button class="text-blue-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-medium text-gray-700">Pediatrics</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Provides medical care for infants, children, and adolescents.</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Doctor, Nurse</td>
                    <td class="px-4 py-3"><span class="text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full">Active</span></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <button class="text-blue-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-medium text-gray-700">Oncology</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Deals with the diagnosis and treatment of cancer.</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Doctor, Nurse</td>
                    <td class="px-4 py-3"><span class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-full">Inactive</span></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <button class="text-blue-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-medium text-gray-700">Emergency Medicine</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Handles immediate medical needs and critical care.</td>
                    <td class="px-4 py-3 text-sm text-gray-600">Doctor, Nurse</td>
                    <td class="px-4 py-3"><span class="text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full">Active</span></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <button class="text-blue-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection
