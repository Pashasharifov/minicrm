<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Title</label>
                            <input type="text" name="title" value="{{ old('title', $task->title) }}"
                                   class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Description</label>
                            <textarea name="description" rows="3"
                                      class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600">{{ old('description', $task->description) }}</textarea>
                        </div>

                        {{-- Project --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Project</label>
                            <select name="project_id"
                                    class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }} ({{ $project->client->name ?? 'No Client' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Assigned User --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Assigned To</label>
                            <select name="assigned_to"
                                    class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <option value="">-- Unassigned --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name . ' ' . $user->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Status</label>
                            <select name="status"
                                    class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                @foreach(['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $task->status) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Due Date --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium mb-2">Due Date</label>
                            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                                   class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        {{-- Buttons --}}
                        <div class="flex justify-between items-center">
                            <a href="{{ route('tasks.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Task</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
