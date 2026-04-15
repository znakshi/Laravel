<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-6 sm:p-8 bg-white dark:bg-gray-800">
                    <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Company Name -->
                            <div>
                                <x-input-label for="name" :value="__('Company Name')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="name" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Contact Name -->
                            <div>
                                <x-input-label for="contact_name" :value="__('Contact Person Name')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="contact_name" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="text" name="contact_name" :value="old('contact_name')" />
                                <x-input-error :messages="$errors->get('contact_name')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="email" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="email" name="email" :value="old('email')" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" class="text-gray-700 dark:text-gray-300" />
                                <x-text-input id="phone" class="block w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-sm" type="text" name="phone" :value="old('phone')" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-500" />
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Physical Address')" class="text-gray-700 dark:text-gray-300" />
                            <textarea id="address" name="address" rows="3" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-800 transition duration-150 ease-in-out">{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2 text-red-500" />
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 dark:focus:ring-gray-600 transition ease-in-out duration-150 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Save Supplier') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
