{{-- resources/views/users/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Əgər validation error varsa --}}
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('clients.update', $client->id) }}">
                        @csrf
                        @method('PUT') {{-- update üçün method spoofing --}}

                         {{-- Contact Name --}}
                        <div class="mb-4">
                            <label for="contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Contact Name
                            </label>
                            <input type="text" name="contact_name" id="contact_name"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->contact_name }}" required>
                        </div>

                        {{-- Email Address --}}
                        <div class="mb-4">
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email Address
                            </label>
                            <input type="text" name="contact_email" id="contact_email"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->contact_email }}" required>
                        </div>

                        {{-- Phone Number --}}
                        <div class="mb-4">
                            <label for="contact_phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Phone Number
                            </label>
                            <input type="text" name="contact_phone_number" id="contact_phone_number"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->contact_phone_number }}" required>
                        </div>

                        {{-- Company Name --}}
                        <div class="mb-4">
                            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company Name
                            </label>
                            <input type="text" name="company_name" id="company_name"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->company_name }}" required>
                        </div>

                        {{-- Company VAT --}}
                        <div class="mb-4">
                            <label for="company_vat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company VAT
                            </label>
                            <input type="text" name="company_vat" id="company_vat"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->company_vat }}" required>
                        </div>

                        {{-- Company Address --}}
                        <div class="mb-4">
                            <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company Address
                            </label>
                            <input type="text" name="company_address" id="company_address"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->company_address }}" required>
                        </div>

                        {{-- Company City --}}
                        <div class="mb-4">
                            <label for="company_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company City
                            </label>
                            <input type="text" name="company_city" id="company_city"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->company_city }}" required>
                        </div>

                        {{-- Company ZIP --}}
                        <div class="mb-4">
                            <label for="company_zip" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company ZIP
                            </label>
                            <input type="text" name="company_zip" id="company_zip"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ $client->company_zip }}" required>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="flex items-center justify-end">
                            <a href="{{ route('clients.index') }}"
                               class="mr-3 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Cancel
                            </a>
                            <button onclick="{{ route('clients.update', $client->id) }}" type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
