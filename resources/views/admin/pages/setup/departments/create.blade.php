@extends('admin.layouts.main')
@section('title', 'Create Department')

@section('content')
<div class="flex justify-center py-10">
    <div class="w-full max-w-3xl bg-white shadow-sm rounded-lg p-8 border border-gray-200">

        <h1 class="text-2xl font-semibold text-center">Create New Department</h1>
        <p class="text-gray-500 text-center mb-8">Set up a new department within the hospital system.</p>

        <form>
            {{-- Department Name --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
                <input type="text" placeholder="e.g., Cardiology"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Description --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
                <textarea rows="4" placeholder="Provide a brief overview of the department's functions."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            {{-- Actor Types --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Actor Types</label>

                <div class="grid grid-cols-2 gap-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-checkbox text-blue-600">
                        <span class="text-gray-700 text-sm">Doctor</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-checkbox text-blue-600">
                        <span class="text-gray-700 text-sm">Nurse</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-checkbox text-blue-600">
                        <span class="text-gray-700 text-sm">Administrator</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-checkbox text-blue-600">
                        <span class="text-gray-700 text-sm">Technician</span>
                    </label>
                </div>
            </div>

            {{-- Status Toggle --}}
            <div class="mb-7">
                <label class="block text-sm font-medium text-gray-700 mb-1">Active Status</label>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-blue-600 relative transition">
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-5"></div>
                    </div>
                </label>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-md text-center">
                Create Department
            </button>

        </form>

    </div>
</div>
@endsection
