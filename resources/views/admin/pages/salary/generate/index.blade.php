@extends('admin.layouts.main')
@section('title', 'Generate Salary')

@section('content')
<div class="px-6 py-8">

    {{-- Heading --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-semibold">Generate Salary</h1>
            <p class="text-sm text-gray-500 mt-1">Generate and manage salaries for selected month</p>
        </div>

        {{-- Month Selector --}}
        <div class="flex items-center gap-3">
            <input type="month"
                class="border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-400 focus:border-blue-400">

            <button class="px-5 py-2.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 shadow-sm">
                Generate Salary
            </button>
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-3 gap-5 mb-8">

        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-500">Employees</div>
            <div class="text-2xl font-semibold mt-1">32</div>
        </div>

        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-500">Total Salary</div>
            <div class="text-2xl font-semibold mt-1">₹ 8,50,000</div>
        </div>

        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-500">Status</div>
            <div class="text-2xl font-semibold mt-1 text-green-600">Generated</div>
        </div>

    </div>

    {{-- Salary Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-600 border-b">
                    <th class="px-5 py-3 font-medium">Employee</th>
                    <th class="px-5 py-3 font-medium">Salary</th>
                    <th class="px-5 py-3 font-medium">Net Pay</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-800">

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center">
                            JD
                        </div>
                        John Doe
                    </td>

                    <td class="px-5 py-3">₹ 35,000</td>
                    <td class="px-5 py-3">₹ 33,200</td>

                    <td class="px-5 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">Paid</span>
                    </td>

                    <td class="px-5 py-3 text-center">
                        <div class="flex justify-center gap-2">
                            <button class="px-3 py-1.5 text-xs bg-gray-200 hover:bg-gray-300 rounded">View</button>
                            <button class="px-3 py-1.5 text-xs bg-red-100 hover:bg-red-200 text-red-600 rounded">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center">
                            SW
                        </div>
                        Sarah Williams
                    </td>

                    <td class="px-5 py-3">₹ 50,000</td>
                    <td class="px-5 py-3">₹ 47,800</td>

                    <td class="px-5 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                    </td>

                    <td class="px-5 py-3 text-center">
                        <div class="flex justify-center gap-2">
                            <button class="px-3 py-1.5 text-xs bg-gray-200 hover:bg-gray-300 rounded">View</button>
                            <button class="px-3 py-1.5 text-xs bg-blue-100 hover:bg-blue-200 text-blue-600 rounded">Mark Paid</button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center">
                            MJ
                        </div>
                        Mark Johnson
                    </td>

                    <td class="px-5 py-3">₹ 42,000</td>
                    <td class="px-5 py-3">₹ 39,500</td>

                    <td class="px-5 py-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">Not Generated</span>
                    </td>

                    <td class="px-5 py-3 text-center">
                        <div class="flex justify-center gap-2">
                            <button class="px-3 py-1.5 text-xs bg-blue-100 hover:bg-blue-200 text-blue-600 rounded">Generate Now</button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

</div>
@endsection
