@extends("super-admin.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-5xl mx-auto mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Hospital</h1>
            <p class="mt-1 text-sm text-gray-500">Update hospital details and admin credentials.</p>
        </div>

        <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <form action="{{ route('super-admin.hospital.update', $hospital->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-5xl mx-auto">
        @csrf

        <!-- Hospital Profile -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-8">
                
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Hospital Profile</h2>

                <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">

                    <!-- Hospital Name -->
                    <div class="sm:col-span-4">
                        <label class="label">Hospital Name</label>
                        <input type="text" name="hospitalName" value="{{ $hospital->hospitalName }}" class="input">
                    </div>

                    <!-- Logo -->
                    <div class="col-span-full">
                        <label class="label">Hospital Logo</label>

                        <div id="logoArea" class="mt-2 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 p-8 cursor-pointer transition">

                            @if($hospital->logo)
                                <img id="logoPreview" src="{{ asset('storage/'.$hospital->logo) }}" class="h-28 mb-4 rounded-md shadow">
                            @else
                                <img id="logoPreview" class="hidden h-28 mb-4 rounded-md shadow">
                            @endif

                            <svg id="uploadIcon" class="h-12 w-12 text-gray-300 {{ $hospital->logo ? 'hidden':'' }}" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v6a5 5 0 005 5h8a5 5 0 005-5V7" />
                            </svg>

                            <p class="text-sm text-gray-500 mt-3">Click to upload or drop image</p>

                            <input id="fileUpload" type="file" name="logo" class="hidden" accept="image/*">
                        </div>
                    </div>

                    <!-- Official Email -->
                    <div class="sm:col-span-3">
                        <label class="label">Official Email</label>
                        <input type="email" name="officialEmail" value="{{ $hospital->officialEmail }}" class="input">
                    </div>

                    <!-- Phone -->
                    <div class="sm:col-span-3">
                        <label class="label">Phone Number</label>
                        <input type="text" name="phone" value="{{ $hospital->phone }}" class="input">
                    </div>

                    <!-- Address -->
                    <div class="col-span-full">
                        <label class="label">Street Address</label>
                        <input type="text" name="address" value="{{ $hospital->address }}" class="input">
                    </div>

                </div>
            </div>
        </div>

        <!-- Admin -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-8">

                <h2 class="text-lg font-semibold text-gray-900 mb-6">Super Administrator</h2>

                <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">

                    <div class="sm:col-span-3">
                        <label class="label">Full Name</label>
                        <input type="text" name="adminName" value="{{ $hospital->adminName }}" class="input">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Admin Email</label>
                        <input type="email" name="email" value="{{ $hospital->email }}" class="input">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Change Password</label>
                        <input type="password" name="password" placeholder="Leave empty to keep same" class="input">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Leave empty to keep same" class="input">
                    </div>

                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <button type="button" class="px-4 py-2 text-gray-700 hover:text-gray-900">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-500">
                Update Hospital
            </button>
        </div>

    </form>
</div>

<script>
    const input = document.getElementById('fileUpload');
    const preview = document.getElementById('logoPreview');
    const icon = document.getElementById('uploadIcon');
    const box = document.getElementById('logoArea');

    box.addEventListener('click', () => input.click());

    input.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
        icon.classList.add('hidden');
    });
</script>

<style>
    .label { @apply block text-sm font-medium text-gray-900 mb-1; }
    .input { @apply w-full rounded-lg border border-gray-300 py-2 px-3 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600; }
</style>

@endsection
