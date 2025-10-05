<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Title --}}
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Title:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $task->title }}</p>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Description:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $task->description ?? '—' }}</p>
                    </div>

                    {{-- Project --}}
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Project:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ $task->project ? $task->project->title : '—' }}
                        </p>
                    </div>

                    {{-- Assigned User --}}
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Assigned To:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ $task->assignedUser ? $task->assignedUser->first_name . ' ' . $task->assignedUser->last_name : 'Unassigned' }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Status:</h3>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium 
                            @if($task->status == 'completed') bg-green-500 text-white 
                            @elseif($task->status == 'in_progress') bg-yellow-500 text-white 
                            @else bg-gray-400 text-white @endif">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>

                    {{-- Due Date --}}
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Due Date:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '—' }}
                        </p>
                    </div>

                    {{-- Created / Updated --}}
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Created At:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ $task->created_at->format('d M Y, H:i') }}
                        </p>
                        <h3 class="text-lg font-semibold mt-3">Last Updated:</h3>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ $task->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('tasks.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit Task</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
