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
                    {{ $metrics['pending'] }} Pending
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    Total: {{ $metrics['total'] }}
                </span>
            </div>
        </div>
    </div>

    {{-- Filter Buttons --}}
    <div class="max-w-7xl mx-auto mb-6">
        <form method="GET" action="{{ route('admin.pages.leave-management.index') }}" class="flex space-x-2">
            @php
                $statuses = ['All', 'Pending', 'Approved', 'Rejected'];
            @endphp
            @foreach ($statuses as $status)
                @php
                    $isActive = ($currentFilter === $status);
                    $baseClasses = 'px-4 py-2 rounded-lg text-sm font-medium border transition-colors';
                    $activeClasses = 'bg-indigo-600 text-white border-indigo-600 shadow-md';
                    $inactiveClasses = 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50';
                @endphp
                <button type="submit" name="status" value="{{ $status }}"
                        class="{{ $baseClasses }} {{ $isActive ? $activeClasses : $inactiveClasses }}">
                    {{ $status }} Requests
                </button>
            @endforeach
        </form>
    </div>

    @if (session('success'))
        <div class="max-w-7xl mx-auto mb-4 p-3 bg-green-100 text-green-700 rounded-lg shadow-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="max-w-7xl mx-auto mb-4 p-3 bg-red-100 text-red-700 rounded-lg shadow-sm">{{ session('error') }}</div>
    @endif

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

                        @forelse ($leaveRequests as $request)
                            @php
                                $statusClasses = match ($request->status) {
                                    'Approved' => 'bg-green-100 text-green-800',
                                    'Rejected' => 'bg-red-100 text-red-800',
                                    default => 'bg-yellow-100 text-yellow-800',
                                };
                                $duration = $request->start_date->diffInDays($request->end_date) + 1;
                                $canAct = $request->status === 'Pending';
                            @endphp
                            <tr class="group hover:bg-blue-50/30 transition-colors {{ !$canAct ? 'opacity-70' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full object-cover border border-gray-200" src="{{ $request->user->employee->picture ? asset('storage/' . $request->user->employee->picture) : 'https://ui-avatars.com/api/?name=' . urlencode($request->user->name) . '&background=random' }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $request->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::title($request->user->role) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-50 text-indigo-700 mb-1">
                                        {{ Str::title($request->type) }}
                                    </span>
                                    <div class="text-sm text-gray-900 font-medium">{{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $duration }} Day{{ $duration > 1 ? 's' : '' }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600 truncate w-48" title="{{ $request->reason }}">
                                        {{ Str::limit($request->reason, 40) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses }}">
                                        {{ $request->status }}
                                    </span>
                                    @if ($request->status === 'Rejected' && $request->rejection_reason)
                                        <p class="text-xs text-red-500 mt-1" title="{{ $request->rejection_reason }}">Reason: {{ Str::limit($request->rejection_reason, 20) }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if ($canAct)
                                            {{-- Approve Action --}}
                                            <form action="{{ route('admin.pages.leave-management.updateStatus', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 transition-colors">
                                                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    Approve
                                                </button>
                                            </form>

                                            {{-- Reject Action (requires confirmation/reason input) --}}
                                            <button 
                                                onclick="promptForRejectionReason('{{ $request->id }}', '{{ $request->user->name }}')" 
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition-colors">
                                                <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Reject
                                            </button>
                                        @else
                                            <span class="text-gray-400 italic text-xs">Action taken</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    No {{ $currentFilter !== 'All' ? Str::lower($currentFilter) : '' }} leave requests found for your hospital.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                 {{ $leaveRequests->links() }} 
            </div>
        </div>
    </div>
</div>

<script>
    function promptForRejectionReason(requestId, userName) {
        const reason = prompt(`Reject leave request for ${userName}.\nEnter reason for rejection:`);
        
        if (reason === null) {
            return; // User cancelled
        }
        
        if (reason.trim() === "") {
            alert("Rejection reason is required.");
            return;
        }

        // Create and submit a form dynamically
        const form = document.createElement('form');
        form.method = 'POST';
        // IMPORTANT: Use the full route defined in your web.php
        form.action = '{{ url('dashboard/leave-management') }}/' + requestId + '/status';
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        form.innerHTML = `
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="Rejected">
            <input type="hidden" name="rejection_reason" value="${reason.trim()}">
        `;
        
        document.body.appendChild(form);
        form.submit();
    }
    
    // NOTE: You need to ensure you have a CSRF token meta tag in your layout:
    // <meta name="csrf-token" content="{{ csrf_token() }}">
</script>
@endsection