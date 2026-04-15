<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Stock Movement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-6 sm:p-8 bg-white dark:bg-gray-800">
                    <form method="POST" action="{{ route('stock-movements.update', $stockMovement) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product ID -->
                            <div>
                                <x-input-label for="product_id" :value="__('Select Product')" class="text-gray-700 dark:text-gray-300" />
                                <select id="product_id" name="product_id" required class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id', $stockMovement->product_id) == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} (SKU: {{ $product->sku }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('product_id')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Type -->
                            <div>
                                <x-input-label for="type" :value="__('Movement Type')" class="text-gray-700 dark:text-gray-300" />
                                <select id="type" name="type" required class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">
                                    <option value="in" {{ old('type', $stockMovement->type) == 'in' ? 'selected' : '' }}>Stock In (Add)</option>
                                    <option value="out" {{ old('type', $stockMovement->type) == 'out' ? 'selected' : '' }}>Stock Out (Remove)</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2 text-red-500" />
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <x-input-label for="quantity" :value="__('Quantity')" class="text-gray-700 dark:text-gray-300" />
                            <x-text-input id="quantity" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="number" name="quantity" :value="old('quantity', $stockMovement->quantity)" min="1" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Reason -->
                        <div>
                            <x-input-label for="reason" :value="__('Reason / Remarks')" class="text-gray-700 dark:text-gray-300" />
                            <textarea id="reason" name="reason" rows="3" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">{{ old('reason', $stockMovement->reason) }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2 text-red-500" />
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('stock-movements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 dark:focus:ring-gray-600 transition ease-in-out duration-150 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Update Movement') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
