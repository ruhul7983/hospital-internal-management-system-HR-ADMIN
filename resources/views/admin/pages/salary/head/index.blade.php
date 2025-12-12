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
    
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
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

                <tbody class="text-gray-800 text-sm divide-y divide-gray-100">

                    @forelse ($heads as $head)
                        @php
                            $isBasicClass = $head->is_basic ? 'bg-indigo-50 font-bold text-indigo-700' : '';
                            $isPercentage = $head->calculation_type === 'Percentage';
                        @endphp
                        <tr class="{{ $isBasicClass }}">
                            <td class="px-5 py-3">{{ $head->name }}</td>
                            <td class="px-5 py-3">{{ $head->type }}</td>
                            <td class="px-5 py-3">{{ $head->calculation_type }}</td>
                            <td class="px-5 py-3">{{ $isPercentage ? ($head->value * 100) . '%' : number_format($head->value, 2) }}</td>
                            <td class="px-5 py-3">
                                <input type="checkbox" {{ $head->is_basic ? 'checked' : '' }} disabled
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600">
                            </td>
                            <td class="px-5 py-3">
                                <input type="checkbox" {{ $head->is_editable ? 'checked' : '' }} disabled
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600">
                            </td>

                            <td class="px-5 py-3">
                                <div class="flex justify-end items-center gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.salary.head.edit', $head->id) }}"
                                        class="px-2 py-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors">
                                        edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.salary.head.delete', $head->id) }}" method="POST" onsubmit="return confirm('WARNING: Deleting {{ $head->name }}. Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors">
                                            delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-gray-500">No salary heads configured yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection