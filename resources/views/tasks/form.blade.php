@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        {{ isset($task) ? 'Update Task' : 'Create Task' }}
    </h1>

    <form id="task-form" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        <input type="hidden" id="task-id" name="task_id" value="{{ $task->id ?? '' }}">

        <div class="col-span-1">
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $task->title ?? '' }}">
            <div class="text-sm text-red-500 mt-1" id="error-title"></div>
        </div>

        <div class="col-span-1">
            <label class="block text-gray-700 font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (isset($task) && $task->category_id == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <div class="text-sm text-red-500 mt-1" id="error-category_id"></div>
        </div>

        <div class="col-span-1">
            <label class="block text-gray-700 font-semibold mb-1">Due Date</label>
            <input type="datetime-local" name="due_date" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '' }}">
            <div class="text-sm text-red-500 mt-1" id="error-due_date"></div>
        </div>

        <div class="col-span-1">
            <label class="block text-gray-700 font-semibold mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(['pending', 'in-progress', 'completed'] as $status)
                    <option value="{{ $status }}" {{ (isset($task) && $task->status == $status) ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            <div class="text-sm text-red-500 mt-1" id="error-status"></div>
        </div>

        <div class="col-span-1">
            <label class="block text-gray-700 font-semibold mb-1">Priority</label>
            <select name="priority" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(['low', 'medium', 'high'] as $priority)
                    <option value="{{ $priority }}" {{ (isset($task) && $task->priority == $priority) ? 'selected' : '' }}>
                        {{ ucfirst($priority) }}
                    </option>
                @endforeach
            </select>
            <div class="text-sm text-red-500 mt-1" id="error-priority"></div>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $task->description ?? '' }}</textarea>
            <div class="text-sm text-red-500 mt-1" id="error-description"></div>
        </div>

        <div class="col-span-1 md:col-span-2 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow-sm transition">
                {{ isset($task) ? 'Update Task' : 'Create Task' }}
            </button>
        </div>
    </form>
</div>
@endsection
