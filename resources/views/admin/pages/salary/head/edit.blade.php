@extends('admin.layouts.main')
@section('title', 'Edit Salary Head')

@section('content')
<div class="flex justify-center py-10">
    <div class="w-full max-w-3xl bg-white shadow-sm rounded-lg p-8 border border-gray-200">

        <h1 class="text-2xl font-semibold text-center">Edit Salary Head</h1>
        <p class="text-gray-500 text-center mb-8">Update the salary head information.</p>

        <form>

            {{-- Name --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" value="House Rent Allowance"
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            {{-- Type --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select class="w-full border rounded-md px-3 py-2">
                    <option>Earning</option>
                    <option selected>Allowance</option>
                    <option>Deduction</option>
                </select>
            </div>

            {{-- Calculation Type --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Calculation Type</label>
                <select class="w-full border rounded-md px-3 py-2">
                    <option>Fixed</option>
                    <option selected>Percentage</option>
                </select>
            </div>

            {{-- Value --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700">Multiplier / Percentage</label>
                <input type="text" value="40%"
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            {{-- Checkboxes --}}
            <div class="mb-6">
                <label class="flex items-center gap-2 mb-2">
                    <input type="checkbox" class="form-checkbox">
                    <span>Set as Basic</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" class="form-checkbox" checked>
                    <span>Editable per User</span>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                Update Salary Head
            </button>

        </form>
    </div>
</div>
@endsection
