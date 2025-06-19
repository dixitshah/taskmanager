@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3">{{ $task->title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p class="mb-2"><span class="font-semibold">Category:</span> {{ $task->category->name ?? '—' }}</p>
                <p class="mb-2"><span class="font-semibold">Due Date:</span> {{ $task->due_date ? $task->due_date->format('Y-m-d H:i') : '—' }}</p>
                <p class="mb-2"><span class="font-semibold">Status:</span> 
                    <span class="inline-block px-2 py-1 rounded text-white 
                        {{ $task->status === 'completed' ? 'bg-green-600' : ($task->status === 'in-progress' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </p>
                <p class="mb-2"><span class="font-semibold">Priority:</span> 
                    <span class="inline-block px-2 py-1 rounded text-white 
                        {{ $task->priority === 'high' ? 'bg-red-600' : ($task->priority === 'medium' ? 'bg-yellow-600' : 'bg-blue-600') }}">
                        {{ ucfirst($task->priority) }}
                    </span>
                </p>
            </div>

            <div>
                <p class="font-semibold mb-1">Description:</p>
                <div class="bg-gray-100 p-4 rounded min-h-[80px]">
                    {{ $task->description ?? 'No description.' }}
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('tasks.edit', $task) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded text-sm inline-block">
                Edit
            </a>

            <button class="delete-btn bg-red-500 text-white px-2 py-1 rounded" data-id="{{ $task->id }}">Delete</button>
        </div>
    </div>
@endsection
