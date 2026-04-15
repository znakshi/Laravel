<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-6 sm:p-8 bg-white dark:bg-gray-800">
                    <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div>
                                <x-input-label for="name" :value="__('Product Name')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="name" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                            </div>

                            <!-- SKU -->
                            <div>
                                <x-input-label for="sku" :value="__('SKU (Stock Keeping Unit)')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="sku" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="text" name="sku" :value="old('sku')" required />
                                <x-input-error :messages="$errors->get('sku')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Category -->
                            <div>
                                <x-input-label for="category_id" :value="__('Category')" class="text-gray-700 dark:text-gray-300" />
                                <select id="category_id" name="category_id" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">
                                    <option value="">None</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Supplier -->
                            <div>
                                <x-input-label for="supplier_id" :value="__('Supplier')" class="text-gray-700 dark:text-gray-300" />
                                <select id="supplier_id" name="supplier_id" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">
                                    <option value="">None</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('supplier_id')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Price -->
                            <div>
                                <x-input-label for="price" :value="__('Price ($)')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="price" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="number" step="0.01" min="0" name="price" :value="old('price', '0.00')" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Quantity -->
                            <div>
                                <x-input-label for="quantity" :value="__('Initial Quantity')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="quantity" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="number" min="0" name="quantity" :value="old('quantity', '0')" required />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2 text-red-500" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Product Description')" class="text-gray-700 dark:text-gray-300" />
                            <textarea id="description" name="description" rows="4" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2 text-red-500" />
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 dark:focus:ring-gray-600 transition ease-in-out duration-150 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Save Product') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
