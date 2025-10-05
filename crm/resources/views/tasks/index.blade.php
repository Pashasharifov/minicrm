<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Əlavə et düyməsi --}}
                    <div class="mb-4">
                        <a href="{{ route('tasks.create') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Add Task
                        </a>
                    </div>

                    {{-- Cədvəl --}}
                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Project</th>
                                <th class="px-4 py-2 border">Client</th>
                                <th class="px-4 py-2 border">Assigned To</th>
                                <th class="px-4 py-2 border">Created By</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Due Date</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $userColors = [
                                    'Deleted User' => 'text-red-600',
                                ];
                            @endphp
                            @forelse($tasks as $index => $task)
                                <tr class="text-gray-800 dark:text-gray-200">
                                    <td class="px-4 py-2 border">{{ $tasks->firstItem() + $index }}</td>

                                    {{-- Title --}}
                                    <td class="px-4 py-2 border font-medium">
                                        {{ $task->title }}
                                    </td>

                                    {{-- Project --}}
                                    <td class="px-4 py-2 border">
                                        {{ $task->project->title ?? '—' }}
                                    </td>

                                    {{-- Client --}}
                                    <td class="px-4 py-2 border">
                                        {{ $task->project->client->contact_name ?? '—' }}
                                    </td>

                                    {{-- Assigned To --}}
                                    <td class="px-4 py-2 border">
                                        {{ $task->assignedUser?->first_name . ' ' . $task->assignedUser?->last_name ?? '—' }}
                                    </td>

                                    {{-- Created By --}}
                                    <td class="px-4 py-2 border {{ $userColors[$task->creator?->first_name ?? 'Deleted User'] ?? '' }} rounded">
                                        {{ $task->creator?->first_name ? ($task->creator?->first_name . ' ' . $task->creator?->last_name) : 'Deleted User' }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-4 py-2 border">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-500',
                                                'in_progress' => 'bg-blue-600',
                                                'completed' => 'bg-green-600',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded text-white text-sm {{ $statusColors[$task->status] ?? 'bg-yellow-500' }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>

                                    {{-- Due Date --}}
                                    <td class="px-4 py-2 border">
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') : '—' }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-4 py-2 border space-x-2">
                                        <a href="{{ route('tasks.show', $task->id) }}"
                                           class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">View</a>
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                           class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure to delete this task?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                        No tasks found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $tasks->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
