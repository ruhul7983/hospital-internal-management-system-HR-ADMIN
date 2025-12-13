@extends("super-admin.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-8 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Overview</h1>
            <p class="mt-2 text-sm text-gray-500">System-wide statistics and hospital management.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3"> 
            
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-xl p-3 shadow-lg shadow-blue-200">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Hospitals</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ $totalHospitals ?? 0 }}</div> 
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        2
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-emerald-500 rounded-xl p-3 shadow-lg shadow-emerald-200">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Doctors</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ $totalDoctors ?? 0 }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        4.1%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-xl p-3 shadow-lg shadow-indigo-200">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Patients</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ $totalPatients ?? 0 }}</div> 
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        12%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            </div>
    </div>
    <div class="max-w-7xl mx-auto mb-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        </div>

    </div>
@endsection