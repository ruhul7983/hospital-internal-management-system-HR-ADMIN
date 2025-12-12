@extends('admin.layouts.main')

@section('content')
<div class="px-6 py-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Employee: {{ $employee->user->name }}</h1>
            <a href="{{ route("admin.pages.employees.index") }}" class="text-sm font-medium text-blue-600 hover:underline">Back to list</a>
        </div>
        
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
        @endif

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('admin.pages.employees.update', $employee->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- 1) Basic (Auth) --}}
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Account & Authentication</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Full Name</label>
                        <input name="name" value="{{ old('name', $employee->user->name) }}" type="text"
                               placeholder="Enter full name"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('name') border-red-500 @enderror" required>
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Email (Login ID)</label>
                        <input name="email" value="{{ old('email', $employee->user->email) }}" type="email"
                               placeholder="name@example.com"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('email') border-red-500 @enderror" required>
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    {{-- MISSING FIELD ADDED HERE: PHONE --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Phone</label>
                        <input name="phone" value="{{ old('phone', $employee->phone) }}" type="text"
                               placeholder="+8801XXXXXXXXX"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">NID</label>
                        <input name="nid" value="{{ old('nid', $employee->nid) }}" type="text"
                               placeholder="National ID"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('nid') border-red-500 @enderror">
                        @error('nid')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    {{-- Password Fields --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">New Password (Leave blank to keep current)</label>
                        <input name="password" type="password"
                               placeholder="New password"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('password') border-red-500 @enderror">
                        @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input name="password_confirmation" type="password"
                               placeholder="Confirm new password"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('password') border-red-500 @enderror">
                    </div>
                </div>

                {{-- 2) Job Details --}}
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4 pt-4">Job Details</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    
                    {{-- Role Dropdown (Doctor, Nurse, Staff) --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Role</label>
                        <select name="role"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('role') border-red-500 @enderror" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ old('role', $employee->user->role) == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    {{-- Department Dropdown (from DB) --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Department</label>
                        <select name="department_id"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('department_id') border-red-500 @enderror">
                            <option value="">No Department / Select one</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Specialty</label>
                        <input name="specialty" value="{{ old('specialty', $employee->specialty) }}" type="text"
                               placeholder="e.g., Cardiac Care"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('specialty') border-red-500 @enderror">
                        @error('specialty')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- 3) Personal Details --}}
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4 pt-4">Personal Details</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input name="dob" value="{{ old('dob', $employee->date_of_birth ? $employee->date_of_birth->format('Y-m-d') : '') }}" type="date"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('dob') border-red-500 @enderror">
                        @error('dob')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Address</label>
                        <input name="address" value="{{ old('address', $employee->address) }}" type="text"
                               placeholder="Street, City, District"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('address') border-red-500 @enderror">
                        @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- 4) Picture + Status --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 pt-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Picture (Current)</label>
                        <input name="picture" type="file" accept="image/*"
                               class="block w-full cursor-pointer rounded-md border border-dashed border-gray-300 bg-gray-50 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-white hover:file:bg-blue-700 focus:outline-none @error('picture') border-red-500 @enderror">
                        @error('picture')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        
                        <img id="preview" 
                             src="{{ $employee->picture ? asset('storage/' . $employee->picture) : '' }}"
                             class="mt-3 {{ $employee->picture ? '' : 'hidden' }} h-24 w-24 rounded-full object-cover ring-1 ring-gray-200"
                             alt="Current Picture Preview"/>
                    </div>
                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-3">
                            <input type="checkbox" name="active" value="1"
                                   class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                   {{ old('active', $employee->user->is_active ?? true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6">
                    <a href="{{ route('admin.pages.employees.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600/50">
                        Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelector('input[name="picture"]')?.addEventListener('change', (e) => {
    const file = e.target.files?.[0];
    if (!file) return;
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(file);
    img.classList.remove('hidden');
});
</script>
@endsection