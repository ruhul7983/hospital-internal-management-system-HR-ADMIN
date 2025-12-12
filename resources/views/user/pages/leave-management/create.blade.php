@extends("user.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-3xl mx-auto mb-8">
        <a href="{{ route('user.leave-management.index') }}" class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors duration-200">
            <div class="mr-2 p-1 rounded-full group-hover:bg-indigo-50 transition-colors duration-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </div>
            Back to Leave List
        </a>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <div class="px-8 py-8 border-b border-gray-100 bg-white">
                <div class="flex items-center space-x-4">
                    <div class="h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">New Leave Request</h3>
                        <p class="mt-1 text-sm text-gray-500">Fill out the form below to submit your application for approval.</p>
                    </div>
                </div>
            </div>

            <div class="px-8 py-8">
                <form action="{{ route('user.leave-management.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-8 gap-x-8 sm:grid-cols-2">
                        
                        <div class="sm:col-span-2">
                            <label for="leave_type" class="block text-sm font-semibold text-gray-700 mb-2">Leave Type</label>
                            <div class="relative">
                                <select id="leave_type" name="leave_type" class="block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 sm:text-sm appearance-none @error('leave_type') border-red-500 @enderror" required>
                                    <option value="" disabled selected>Select a leave type...</option>
                                    @foreach ($leaveTypes as $key => $type)
                                        <option value="{{ $key }}" {{ old('leave_type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('leave_type')
                                <p class="mt-2 text-sm text-red-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-1">
                            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 sm:text-sm @error('start_date') border-red-500 @enderror" required>
                            @error('start_date')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-1">
                            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 sm:text-sm @error('end_date') border-red-500 @enderror" required>
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="reason" class="block text-sm font-semibold text-gray-700 mb-2">Reason for Leave</label>
                            <div class="mt-1">
                                <textarea id="reason" name="reason" rows="4" class="block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 sm:text-sm resize-none @error('reason') border-red-500 @enderror" placeholder="Please describe why you need this leave..." required>{{ old('reason') }}</textarea>
                            </div>
                            @error('reason')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end space-x-4">
                        <a href="{{ route('user.leave-management.index') }}" class="px-6 py-3 rounded-lg border border-gray-300 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 rounded-lg border border-transparent bg-indigo-600 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:shadow-lg">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection