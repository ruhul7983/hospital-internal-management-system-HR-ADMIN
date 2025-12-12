@extends("super-admin.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-5xl mx-auto mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Register New Hospital</h1>
            <p class="mt-1 text-sm text-gray-500">Onboard a new medical facility and assign an administrator.</p>
        </div>

        <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    {{-- Global Error Display (if something failed in the transaction) --}}
    @if(session('error'))
        <div class="max-w-5xl mx-auto mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('super-admin.hospital.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-5xl mx-auto">
        @csrf

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-8">
                
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Hospital Profile</h2>

                <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">

                    <div class="sm:col-span-4">
                        <label class="label">Hospital Name</label>
                        <input type="text" name="hospitalName" value="{{ old('hospitalName') }}" placeholder="Ex: City General Hospital" class="input @error('hospitalName') border-red-500 @enderror" required>
                        @error('hospitalName')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label class="label">Hospital Logo</label>

                        <div id="logoArea" class="mt-2 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 p-8 cursor-pointer transition @error('logo') border-red-500 @enderror">
                            
                            <img id="logoPreview" class="hidden h-28 object-contain mb-4 rounded-md shadow">

                            <svg id="uploadIcon" class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v6a5 5 0 005 5h8a5 5 0 005-5V7M3 7l4-4m-4 4l4 4m10-4l4-4m-4 4l4 4" />
                            </svg>

                            <p class="text-sm text-gray-500 mt-3">Click to upload or drop image</p>

                            <input id="fileUpload" type="file" name="logo" class="hidden" accept="image/*">
                        </div>
                        @error('logo')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Official Email</label>
                        <input type="email" name="officialEmail" value="{{ old('officialEmail') }}" placeholder="official@hospital.com" class="input @error('officialEmail') border-red-500 @enderror" required>
                        @error('officialEmail')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+880 1234-567890" class="input @error('phone') border-red-500 @enderror" required>
                        @error('phone')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label class="label">Street Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Ex: 445/A, Mirpur DOHS, Dhaka" class="input @error('address') border-red-500 @enderror" required>
                        @error('address')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-8">

                <h2 class="text-lg font-semibold text-gray-900 mb-6">Super Administrator</h2>

                <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">

                    <div class="sm:col-span-3">
                        <label class="label">Full Name</label>
                        <input type="text" name="adminName" value="{{ old('adminName') }}" placeholder="Admin Full Name" class="input @error('adminName') border-red-500 @enderror" required>
                        @error('adminName')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Admin Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@hospital.com" class="input @error('email') border-red-500 @enderror" required>
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Password</label>
                        <input type="password" name="password" placeholder="Create password" class="input @error('password') border-red-500 @enderror" required>
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label class="label">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm password" class="input @error('password_confirmation') border-red-500 @enderror" required>
                        {{-- Laravel's 'confirmed' rule uses the name of the original field for the error key ('password') --}}
                    </div>

                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <button type="button" class="px-4 py-2 rounded-md text-gray-700 hover:text-gray-900">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-500">
                Create Hospital
            </button>
        </div>

    </form>
</div>

{{-- JS Preview --}}
<script>
    const input = document.getElementById('fileUpload');
    const preview = document.getElementById('logoPreview');
    const icon = document.getElementById('uploadIcon');
    const box = document.getElementById('logoArea');

    box.addEventListener('click', () => input.click());

    input.addEventListener('change', e => {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        }
    });
</script>

<style>
    /* Updated .input style to include px-2 py-1 and border-gray-300 by default */
    .label { @apply block text-sm font-medium text-gray-900 mb-1; }
    .input { @apply w-full rounded-lg border border-gray-300 py-2 px-3 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600; }
</style>

@endsection