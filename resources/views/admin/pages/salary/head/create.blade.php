@extends('admin.layouts.main')
@section('title', 'Add Salary Head')

@section('content')
<div class="flex justify-center py-10">
    <div class="w-full max-w-3xl bg-white shadow-sm rounded-lg p-8 border border-gray-200">

        <h1 class="text-2xl font-semibold text-center">Add Salary Head</h1>
        <p class="text-gray-500 text-center mb-8">Fill in the salary head details below.</p>

        <form>

            {{-- Name --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Type --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select class="w-full border rounded-md px-3 py-2">
                    <option>Earning</option>
                    <option>Deduction</option>
                    <option>Allowance</option>
                </select>
            </div>

            {{-- Calculation Type --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Calculation Type</label>
                <select class="w-full border rounded-md px-3 py-2">
                    <option>Fixed</option>
                    <option>Percentage</option>
                </select>
            </div>

            {{-- Value --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Multiplier / Percentage</label>
                <input type="text"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Checkboxes --}}
            <div class="mb-6">
                <label class="flex items-center gap-2 mb-2">
                    <input type="checkbox" class="form-checkbox">
                    <span>Set as Basic</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" class="form-checkbox">
                    <span>Editable per User</span>
                </label>
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
