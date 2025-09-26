{{-- resources/views/users/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Project') }}
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

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title
                            </label>
                            <input type="text" name="title" id="title"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('title') }}" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Description
                            </label>
                            <input type="text" name="description" id="description"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('description') }}" required>
                        </div>

                        {{-- Deadline --}}
                        <div class="mb-4">
                            <label for="deadline_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Deadline
                            </label>
                            <input type="date" name="deadline_at" id="deadline_at"
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-600
                                          dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm"
                                   value="{{ old('deadline_at') }}" required>
                        </div>

                        {{-- Assigned User --}}
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Assigned User
                            </label>
                            <select name="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @selected(old('user_id') == $user->id)>{{ $user->first_name . $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Assigned CLient --}}
                        <div class="mb-4">
                            <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Assigned CLient
                            </label>
                            <select name="client_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        @selected(old('client_id') == $client->id)>{{ $client->company_name  }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="mb-4">
                            <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status
                            </label>
                             <select name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach (\App\Enums\ProjectStatus::cases() as $status)
                                    <option value="{{ $status->value }}"
                                        @selected(old('status') == $status->value)>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex items-center justify-end">
                            <a href="{{ route('projects.index') }}"
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
