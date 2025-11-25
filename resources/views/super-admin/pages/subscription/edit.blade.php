@extends("super-admin.layouts.main")

@section("content")
<div class="min-h-screen bg-gray-50/50 py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-3xl mx-auto mb-6">
        <a href="{{ route('super-admin.plans.index') }}" class="flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Plans
        </a>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Edit Plan: {{ $plan->name }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Update pricing and features.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <div class="px-8 py-8">
                <form action="{{ route('super-admin.plans.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-semibold text-gray-700">Plan Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $plan->name) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="duration" class="block text-sm font-semibold text-gray-700">Billing Cycle</label>
                            <select id="duration" name="duration" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5">
                                <option value="monthly" {{ $plan->duration == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ $plan->duration == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                <option value="lifetime" {{ $plan->duration == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="price" class="block text-sm font-semibold text-gray-700">Price</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm font-bold">৳</span>
                                </div>
                                <input type="number" name="price" id="price" value="{{ old('price', $plan->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 sm:text-sm border-gray-300 rounded-lg py-2.5" step="0.01">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="sort_order" class="block text-sm font-semibold text-gray-700">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $plan->sort_order) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5">
                        </div>

                        <div class="sm:col-span-6">
                            <label for="features" class="block text-sm font-semibold text-gray-700">Plan Features</label>
                            <p class="text-xs text-gray-500 mb-2">Enter features one per line.</p>
                            <textarea id="features" name="features" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg">{{ old('features', $plan->features) }}</textarea>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700">Short Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $plan->description) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5">
                        </div>

                        <div class="sm:col-span-6 flex items-center space-x-8 pt-4">
                            
                            <div class="flex items-center">
                                <input id="is_active" name="is_active" type="checkbox" {{ $plan->is_active ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900"> Active </label>
                            </div>

                            <div class="flex items-center">
                                <input id="is_recommended" name="is_recommended" type="checkbox" {{ $plan->is_recommended ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_recommended" class="ml-2 block text-sm text-gray-900"> Recommended (Featured) </label>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('super-admin.plans.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Update Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection