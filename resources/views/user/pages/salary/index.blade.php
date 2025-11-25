@extends("user.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">My Salary & Payouts</h1>
            <p class="mt-1 text-sm text-gray-500">View your payment history and download payslips.</p>
        </div>
        
        <div class="flex items-center space-x-2 bg-white p-1.5 rounded-xl border border-gray-200 shadow-sm">
            <span class="pl-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Year:</span>
            <div class="relative">
                <select class="appearance-none bg-transparent border-none text-gray-900 text-sm font-bold focus:ring-0 cursor-pointer pr-8 py-1">
                    <option selected>2025</option>
                    <option>2024</option>
                    <option>2023</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center text-gray-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="relative">
                    <p class="text-sm font-medium text-gray-500">Last Payout (Nov)</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-600">$4,250.00</p>
                    <div class="mt-2 flex items-center text-xs text-gray-500">
                        <svg class="h-4 w-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Paid on Nov 28, 2025
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <p class="text-sm font-medium text-gray-500">Total Earnings (YTD)</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">$46,750.00</p>
                <p class="mt-2 text-xs text-gray-400">Jan 2025 - Present</p>
            </div>

            <div class="bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200 border border-indigo-500 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-indigo-100">Next Payday</p>
                        <p class="mt-2 text-3xl font-bold">Dec 28</p>
                    </div>
                    <div class="h-12 w-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <p class="mt-2 text-xs text-indigo-200">Approx. 23 working days remaining</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Payment History</h3>
                <button class="text-sm text-indigo-600 font-medium hover:text-indigo-800">Download All CSV</button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Month</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Salary Breakdown</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deductions</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Net Pay</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500 font-bold text-xs">
                                        NOV
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">November 2025</div>
                                        <div class="text-xs text-gray-500">ID: #PAY-8823</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Basic: <span class="font-medium">$3,500</span></div>
                                <div class="text-xs text-gray-500">Allowance: +$1,000</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="text-sm text-red-500 font-medium">-$250.00</span>
                                <div class="text-xs text-gray-400">Tax & Insurance</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="text-sm font-bold text-emerald-600">$4,250.00</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors" title="View Details">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-900 transition-colors" title="Download PDF">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500 font-bold text-xs">
                                        OCT
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">October 2025</div>
                                        <div class="text-xs text-gray-500">ID: #PAY-8102</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Basic: <span class="font-medium">$3,500</span></div>
                                <div class="text-xs text-gray-500">Allowance: +$1,000</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="text-sm text-red-500 font-medium">-$250.00</span>
                                <div class="text-xs text-gray-400">Tax & Insurance</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="text-sm font-bold text-emerald-600">$4,250.00</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Paid
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-900 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-yellow-50/30 hover:bg-yellow-50/60 transition-colors border-l-4 border-yellow-400">
                            <td class="px-6 py-5 whitespace-nowrap pl-5"> {{-- Adjusted padding for border --}}
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600 font-bold text-xs">
                                        DEC
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">December 2025</div>
                                        <div class="text-xs text-gray-500">Processing...</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Basic: <span class="font-medium">$3,500</span></div>
                                <div class="text-xs text-gray-500">Allowance: Pending</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="text-sm text-gray-400 font-medium">--</span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="text-sm font-bold text-gray-400">Calculating</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Questions about your salary? Contact <a href="#" class="text-indigo-600 hover:underline">HR Department</a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection