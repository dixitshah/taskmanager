<table class="min-w-full divide-y divide-gray-200 text-sm">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Title</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Category</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Due Date</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
            <th class="px-4 py-2 text-left font-medium text-gray-700">Priority</th>
            <th class="px-4 py-2 text-center font-medium text-gray-700">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @forelse($tasks as $task)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2">{{ $task->title }}</td>
                <td class="px-4 py-2">{{ $task->category->name ?? '—' }}</td>
                <td class="px-4 py-2">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '—' }}</td>
                <td class="px-4 py-2 capitalize">{{ $task->status }}</td>
                <td class="px-4 py-2 capitalize">{{ $task->priority }}</td>
                <td class="px-4 py-2 text-center">
                    <a href="{{ route('tasks.show', $task) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded text-sm mr-2 inline-block">View</a>
                    <a href="{{ route('tasks.edit', $task) }}"  class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded text-sm inline-block"> Edit </a>

                    <button class="delete-btn bg-red-500 text-white px-2 py-1 rounded" data-id="{{ $task->id }}">Delete</button>


                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-4 text-center text-gray-500">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
