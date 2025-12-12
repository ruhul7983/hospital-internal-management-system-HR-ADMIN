@extends("super-admin.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-10 px-4 sm:px-6 lg:px-8">
    {{-- ... (header and filters remain the same) ... --}}

    <div class="max-w-7xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Registered Hospitals</h1>
            <p class="mt-1 text-sm text-gray-500">Manage all hospital tenants and their statuses.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route("super-admin.hospital.create") }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Register New Hospital
            </a>
        </div>
    </div>

    {{-- Session Message for Success/Errors --}}
    @if (session('success'))
        <div class="max-w-7xl mx-auto mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="max-w-7xl mx-auto mb-6">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 items-center justify-between">
            
            {{-- Search Bar --}}
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors" placeholder="Search by name, ID, or city...">
            </div>

            {{-- Status Filter --}}
            <div class="flex gap-3 w-full md:w-auto overflow-x-auto">
                <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg">
                    <option>All Statuses</option>
                    <option>Active</option>
                    <option>Pending</option>
                    <option>Suspended</option>
                </select>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Hospital Details</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Contact</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th> 
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        
                        {{-- START THE DYNAMIC LOOP --}}
                        @forelse ($hospitals as $hospital)
                            <tr class="group hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{-- Hospital Logo/Initials --}}
                                        <div class="flex-shrink-0 h-12 w-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold text-lg shadow-sm overflow-hidden">
                                            @if ($hospital->logo)
                                                <img src="{{ asset('storage/' . $hospital->logo) }}" alt="{{ $hospital->hospitalName }} Logo" class="w-full h-full object-cover">
                                            @else
                                                {{ substr($hospital->hospitalName, 0, 2) }}
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            {{-- Hospital Name and Address --}}
                                            <div class="text-sm font-bold text-gray-900">{{ $hospital->hospitalName }}</div>
                                            <div class="text-xs text-gray-500 flex items-center mt-0.5">
                                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $hospital->address }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- Admin Name and Email - USING THE RELATIONSHIP --}}
                                    @if($hospital->administrator)
                                        <div class="text-sm font-medium text-gray-900">{{ $hospital->administrator->name }}</div>
                                        <div class="text-xs text-gray-500 group-hover:text-indigo-600 cursor-pointer">{{ $hospital->administrator->email }}</div>
                                    @else
                                        <div class="text-xs text-red-500">Admin Not Found</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- Simple Status Display (You'll need logic to determine the real status) --}}
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('super-admin.hospital.edit', $hospital->id) }}" class="text-gray-400 hover:text-indigo-600 transition-colors" title="Manage / Edit">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        {{-- Delete Button (Optional, using a form for DELETE request) --}}
                                        <form action="{{ route('super-admin.hospital.delete', $hospital->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hospital?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Delete Hospital">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    No hospitals registered yet. Click "Register New Hospital" to begin.
                                </td>
                            </tr>
                        @endforelse
                        {{-- END THE DYNAMIC LOOP --}}

                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $hospitals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection