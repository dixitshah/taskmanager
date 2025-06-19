@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">My Tasks</h1>
    <div class="bg-white shadow-md rounded-md p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-sm font-medium text-gray-700">Search</label>
                <input type="text" id="task-search" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search by title or description">
            </div>
    
            <div>
                <label class="text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="task-status" class="w-full border rounded p-2">
                    <option value="">-- Select Status --</option>
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                
            </div>
    
            <div>
                <label class="text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="task-category" class="w-full border rounded p-2">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto bg-white shadow-md rounded-md" id="task-list">

        @include('tasks.partials.task-list', ['tasks' => $tasks])
    </div>

@endsection
