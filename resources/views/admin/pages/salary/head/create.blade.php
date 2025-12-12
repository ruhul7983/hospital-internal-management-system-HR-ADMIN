@extends('admin.layouts.main')
@section('title', 'Add Salary Head')

@section('content')
<div class="flex justify-center py-10">
    <div class="w-full max-w-3xl bg-white shadow-sm rounded-lg p-8 border border-gray-200">

        <h1 class="text-2xl font-semibold text-center">Add Salary Head</h1>
        <p class="text-gray-500 text-center mb-8">Fill in the salary head details below.</p>
        
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">Please check the form for errors.</div>
        @endif

        <form method="POST" action="{{ route('admin.salary.head.store') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Type --}}
            <div class="mb-5">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type" required
                    class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror">
                    @foreach ($types as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Calculation Type --}}
            <div class="mb-5">
                <label for="calculation_type" class="block text-sm font-medium text-gray-700">Calculation Type</label>
                <select name="calculation_type" id="calculation_type" required
                    class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('calculation_type') border-red-500 @enderror">
                    @foreach ($calculationTypes as $calc)
                        <option value="{{ $calc }}" {{ old('calculation_type') == $calc ? 'selected' : '' }}>{{ $calc }}</option>
                    @endforeach
                </select>
                @error('calculation_type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Value --}}
            <div class="mb-5">
                <label for="value" class="block text-sm font-medium text-gray-700">Multiplier / Percentage (e.g. 5000 or 0.40)</label>
                <input type="text" name="value" id="value" value="{{ old('value') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('value') border-red-500 @enderror">
                @error('value')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Checkboxes --}}
            <div class="mb-6 space-y-3">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_basic" value="1" {{ old('is_basic') ? 'checked' : '' }}
                           class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Set as Basic Salary (Only one can be basic)</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_editable" value="1" {{ old('is_editable') ? 'checked' : '' }}
                           class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Editable per User (Can be customized individually)</span>
                </label>
                @error('is_basic')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                Save Salary Head
            </button>

        </form>
    </div>
</div>
@endsection