{{-- resources/views/users/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add User') }}
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

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        {{-- First Name --}}
                        <div class="mb-4">
                            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                First Name
                            </label>
                            <input type="text" name="first_name" id="first_name"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('first_name') }}" required>
                        </div>

                        {{-- Last Name --}}
                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Last Name
                            </label>
                            <input type="text" name="last_name" id="last_name"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('last_name') }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('email') }}" required>
                        </div>
                        {{-- Password --}}
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('password') }}" required>
                        </div>
                        {{-- Password Confirmation --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password Confirmation
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('password_confirmation') }}" required>
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex items-center justify-end">
                            <a href="{{ route('users.index') }}"
                               class="mr-3 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
