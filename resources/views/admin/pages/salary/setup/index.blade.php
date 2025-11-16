@extends('admin.layouts.main')
@section('title', 'Salary Setup')

@section('content')
<div class="px-6 py-8">

    <h1 class="text-2xl font-semibold mb-6">Salary Setup</h1>

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT: USER LIST --}}
        <div class="col-span-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-5 py-4 border-b flex justify-between items-center">
                <h2 class="font-semibold text-gray-700">Employees</h2>
                <input type="text" placeholder="Search..."
                    class="text-sm rounded-md border-gray-300 px-2 py-1 w-32 focus:ring-blue-400 focus:border-blue-400">
            </div>

            <div class="divide-y max-h-[650px] overflow-y-auto">

                {{-- Active User Example --}}
                <button class="w-full flex items-center gap-3 px-5 py-4 bg-blue-50 hover:bg-blue-100 transition">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold">
                        JD
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-gray-800">John Doe</div>
                        <div class="text-sm text-gray-500">EMP001</div>
                    </div>
                </button>

                <button class="w-full flex items-center gap-3 px-5 py-4 hover:bg-gray-50 transition">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">
                        SW
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-gray-800">Sarah Wilson</div>
                        <div class="text-sm text-gray-500">EMP002</div>
                    </div>
                </button>

                <button class="w-full flex items-center gap-3 px-5 py-4 hover:bg-gray-50 transition">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">
                        MJ
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-gray-800">Mark Johnson</div>
                        <div class="text-sm text-gray-500">EMP003</div>
                    </div>
                </button>

            </div>
        </div>

        {{-- RIGHT: SALARY DETAILS --}}
        <div class="col-span-8 bg-white border border-gray-200 rounded-xl shadow-sm">

            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Salary Setup - <span class="text-blue-600">John Doe</span></h2>
                <p class="text-sm text-gray-500">Assign or update salary structure for this employee.</p>
            </div>

            <div class="p-6 space-y-6">

                {{-- Salary Heads --}}
                <div class="space-y-4">

                    {{-- Salary Row --}}
                    <div class="p-4 bg-gray-50 rounded-xl border flex justify-between items-center">
                        <div>
                            <div class="font-medium text-gray-800">Basic Salary</div>
                            <div class="text-sm text-gray-500">Fixed</div>
                        </div>
                        <input type="number" class="rounded-md border-gray-300 w-40 text-right" value="10000">
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl border flex justify-between items-center">
                        <div>
                            <div class="font-medium text-gray-800">House Rent Allowance</div>
                            <div class="text-sm text-gray-500">40% of Basic</div>
                        </div>
                        <input type="number" class="rounded-md border-gray-300 w-40 text-right" value="4000">
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl border flex justify-between items-center">
                        <div>
                            <div class="font-medium text-gray-800">Conveyance Allowance</div>
                            <div class="text-sm text-gray-500">Fixed</div>
                        </div>
                        <input type="number" class="rounded-md border-gray-300 w-40 text-right" value="1600">
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl border flex justify-between items-center">
                        <div>
                            <div class="font-medium text-gray-800">Provident Fund</div>
                            <div class="text-sm text-gray-500">12%</div>
                        </div>
                        <input type="number" class="rounded-md border-gray-300 w-40 text-right" value="1200">
                    </div>

                </div>

                {{-- Week Off UI --}}
                <div class="mt-8">
                    <h3 class="font-medium text-gray-800 mb-3">Week Off Day</h3>

                    <div class="flex gap-2 flex-wrap">
                        @foreach (['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)
                            <button class="px-4 py-2 text-sm rounded-full border border-gray-300 hover:bg-gray-100 transition
                                         {{ $day == 'Sat' ? 'bg-blue-600 text-white border-blue-600' : '' }}">
                                {{ $day }}
                            </button>
                        @endforeach
                    </div>

                    <p class="text-xs text-gray-500 mt-1">Select the weekly off day for this employee.</p>
                </div>

                {{-- Save Button --}}
                <div class="pt-4">
                    <button class="px-6 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-sm">
                        Save Salary Setup
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
