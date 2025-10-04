{{-- resources/views/users/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Əlavə et düyməsi --}}
                    <div class="mb-4">
                        <a href="{{ route('projects.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Add Project
                        </a>
                    </div>

                    {{-- Cədvəl --}}
                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Assigned To</th>
                                <th class="px-4 py-2 border">Client</th>
                                <th class="px-4 py-2 border">Deadline</th>
                                <th class="px-4 py-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $userColors = [
                                    'Deleted User' => 'bg-red-600 text-white', 
                                ];
                            @endphp
                            @forelse($projects as $index => $project)
                                <tr class="text-gray-800 dark:text-gray-200">
                                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $project->title }}</td>
                                    <td class="px-4 py-2 border {{ $userColors[$project->user ? $project->user->first_name . ' ' . $project->user->last_name : 'Deleted User'] ?? '' }} rounded">
                                        {{ $project->user ? $project->user->first_name . ' ' . $project->user->last_name : 'Deleted User' }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $project->client->company_name }}</td>
                                    <td class="px-4 py-2 border">{{ $project->deadline_at }}</td>
                                    <td class="px-4 py-2 border">{{ $project->status }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                            class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Edit</a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure to delete this project?')">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="{{ route('projects.destroy', $project->id) }}"
                                                type="submit"
                                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                        No projects found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Pagination linkləri --}}
                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
