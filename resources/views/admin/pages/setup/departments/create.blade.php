@extends('admin.layouts.main')
@section('title', 'Create Department')

@section('content')
<div class="flex justify-center py-10">
    <div class="w-full max-w-3xl bg-white shadow-sm rounded-lg p-8 border border-gray-200">

        <h1 class="text-2xl font-semibold text-center">Create New Department</h1>
        <p class="text-gray-500 text-center mb-8">Set up a new department within the hospital system.</p>

        {{-- Session message container --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">Please fix the errors below.</div>
        @endif
        
        <form method="POST" action="{{ route('admin.pages.setup.departments.store') }}">
            @csrf

            {{-- Department Name --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Department Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Cardiology"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="description">Description (Optional)</label>
                <textarea rows="4" id="description" name="description" placeholder="Provide a brief overview of the department's functions."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actor Types Checkboxes --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Actor Types</label>

                <div class="grid grid-cols-2 gap-2">
                    {{-- $actorTypes is passed from the controller --}}
                    @foreach ($actorTypes as $actor)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="actor_types[]" value="{{ $actor }}"
                                class="form-checkbox text-blue-600"
                                @checked(is_array(old('actor_types')) && in_array($actor, old('actor_types')))>
                            <span class="text-gray-700 text-sm">{{ $actor }}</span>
                        </label>
                    @endforeach
                </div>
                @error('actor_types')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Toggle --}}
            <div class="mb-7">
                <label class="block text-sm font-medium text-gray-700 mb-1">Active Status</label>

                <label class="inline-flex items-center cursor-pointer">
                    {{-- Checkbox for status - Laravel only sends the field if it's checked --}}
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" @checked(old('is_active', true))>
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