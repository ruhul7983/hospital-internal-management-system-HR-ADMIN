@extends("admin.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto mb-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Leave Requests</h1>
                <p class="mt-1 text-sm text-gray-500">Manage and review employee leave applications.</p>
            </div>
            
            <div class="mt-4 sm:mt-0 flex space-x-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                    5 Pending
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    Total: 124
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mb-6">
        <div class="flex space-x-2">
            <button class="px-4 py-2 rounded-lg bg-gray-900 text-white text-sm font-medium shadow-md">All Requests</button>
            <button class="px-4 py-2 rounded-lg bg-white text-gray-700 text-sm font-medium border border-gray-200 hover:bg-gray-50">Pending</button>
            <button class="px-4 py-2 rounded-lg bg-white text-gray-700 text-sm font-medium border border-gray-200 hover:bg-gray-50">Approved</button>
            <button class="px-4 py-2 rounded-lg bg-white text-gray-700 text-sm font-medium border border-gray-200 hover:bg-gray-50">Rejected</button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Employee</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Leave Details</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Duration</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Reason</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">

                        <tr class="group hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full object-cover border border-gray-200" src="https://ui-avatars.com/api/?name=Ruhul+Amin&background=random" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">Ruhul Amin</div>
                                        <div class="text-xs text-gray-500">Nurse</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-50 text-indigo-700 mb-1">
                                    Sick Leave
                                </span>
                                <div class="text-sm text-gray-900 font-medium">Nov 25 - Nov 26</div>
                                <div class="text-xs text-gray-500">2025</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                2 Days
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 truncate w-48" title="Running high fever and need rest as per doctor advice.">
                                    Running high fever and need rest as per...
                                </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <form action="#" method="POST" class="inline">
                                        @csrf
                                        {{-- @method('PATCH') --}}
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                            <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Approve
                                        </button>
                                    </form>

                                    <form action="#" method="POST" class="inline">
                                        @csrf
                                        {{-- @method('PATCH') --}}
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                            <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <tr class="group hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full object-cover border border-gray-200" src="https://ui-avatars.com/api/?name=Sarah+Smith&background=random" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">Sarah Smith</div>
                                        <div class="text-xs text-gray-500">Doctor</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-50 text-pink-700 mb-1">
                                    Casual Leave
                                </span>
                                <div class="text-sm text-gray-900 font-medium">Dec 01 - Dec 03</div>
                                <div class="text-xs text-gray-500">2025</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                3 Days
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 truncate w-48">Family wedding.</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                                        Approve
                                    </button>
                                    <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200">
                                        Reject
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-gray-50 opacity-75">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 grayscale">
                                        <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-700">John Doe</div>
                                        <div class="text-xs text-gray-500">Staff</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600 mb-1">
                                    Sick Leave
                                </span>
                                <div class="text-sm text-gray-700">Oct 10</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                1 Day
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-500 truncate w-48">Medical checkup.</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Approved
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <span class="text-gray-400 italic text-xs">Action taken by Admin</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                            </p>
                        </div>
                        <div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection