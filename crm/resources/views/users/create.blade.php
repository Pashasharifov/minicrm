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

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
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
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password Confirmation
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                value="{{ old('password_confirmation') }}" required>
                        </div>
                        {{-- Avatar (File Upload) --}}
                        <div class="mb-4">
                            <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Avatar
                            </label>
                            <input type="file" name="avatar" id="avatar"
                                class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100
                                          border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100">
                        </div>

                        @if (Auth::user()->isAdmin())
                        {{-- Permissions --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Permissions</h3>

                            @php
                                $permissions = [
                                    'users_create' => 'Create Users',
                                    'users_edit' => 'Edit Users',
                                    'users_delete' => 'Delete Users',
                                    'users_view' => 'View Users',
                                    'clients_create' => 'Create Clients',
                                    'clients_edit' => 'Edit Clients',
                                    'clients_delete' => 'Delete Clients',
                                    'clients_view' => 'View Clients',
                                    'projects_create' => 'Create Projects',
                                    'projects_edit' => 'Edit Projects',
                                    'projects_delete' => 'Delete Projects',
                                    'projects_view' => 'View Projects',
                                    'tasks_create' => 'Create Tasks',
                                    'tasks_edit' => 'Edit Tasks',
                                    'tasks_delete' => 'Delete Tasks',
                                    'tasks_view' => 'View Tasks',
                                ];
                            @endphp

                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($permissions as $key => $label)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[{{ $key }}]" value="1"
                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif


                        {{-- Submit Button --}}
                        <div class="flex items-center justify-end">
                            <a href="{{ route('users.index') }}"
                                class="mr-3 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
