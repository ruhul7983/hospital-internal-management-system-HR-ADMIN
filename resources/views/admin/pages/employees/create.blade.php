@extends('admin.layouts.main')

@section('content')
<div class="px-6 py-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Add Employee</h1>
            <a href={{ route("admin.pages.employees.index") }} class="text-sm font-medium text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <form method="POST" action="#" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- 1) Basic --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Full Name</label>
                        <input name="name" value="{{ old('name') }}" type="text"
                               placeholder="Enter full name"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" value="{{ old('email') }}" type="email"
                               placeholder="name@example.com"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Phone</label>
                        <input name="phone" value="{{ old('phone') }}" type="text"
                               placeholder="+8801XXXXXXXXX"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">NID</label>
                        <input name="nid" value="{{ old('nid') }}" type="text"
                               placeholder="National ID"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('nid')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- 2) Job --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Role</label>
                        <input name="role" value="{{ old('role') }}" type="text"
                               placeholder="e.g., Nurse"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('role')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Department</label>
                        <input name="department" value="{{ old('department') }}" type="text"
                               placeholder="e.g., Cardiology"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('department')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Specialty</label>
                        <input name="specialty" value="{{ old('specialty') }}" type="text"
                               placeholder="e.g., Cardiac Care"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('specialty')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- 3) Personal --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input name="dob" value="{{ old('dob') }}" type="date"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('dob')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Address</label>
                        <input name="address" value="{{ old('address') }}" type="text"
                               placeholder="Street, City, District"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 placeholder:text-gray-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                        @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- 4) Picture + Status --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Picture</label>
                        <input name="picture" type="file" accept="image/*"
                               class="block w-full cursor-pointer rounded-md border border-dashed border-gray-300 bg-gray-50 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-white hover:file:bg-blue-700 focus:outline-none">
                        @error('picture')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        <img id="preview" class="mt-3 hidden h-24 w-24 rounded-full object-cover ring-1 ring-gray-200"/>
                    </div>
                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-3">
                            <input type="checkbox" name="active" value="1"
                                   class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                   {{ old('active', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="#" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600/50">
                        Save Employee
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
