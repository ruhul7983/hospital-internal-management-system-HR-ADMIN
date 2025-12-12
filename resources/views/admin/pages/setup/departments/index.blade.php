@extends('admin.layouts.main')
@section('title', 'Departments')

@section('content')
<div class="p-6">

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Departments</h1>
        <a href="{{ route("admin.pages.setup.departments.create") }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center gap-2">
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
                @forelse ($departments as $department)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm font-medium text-gray-700">{{ $department->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($department->description, 50) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            {{ $department->actor_types ? implode(', ', $department->actor_types) : 'None' }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($department->is_active)
                                <span class="text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full">Active</span>
                            @else
                                <span class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route("admin.pages.setup.departments.edit", $department->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            
                            {{-- Delete Form --}}
                            <form action="{{ route("admin.pages.setup.departments.delete", $department->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete {{ $department->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No departments found for this hospital.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection