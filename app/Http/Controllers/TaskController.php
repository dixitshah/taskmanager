<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }


    public function index(Request $request)
    {
        $query = Task::with('category')->where('user_id', Auth::id());

        if ($request->ajax()) {
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $tasks = $query->get();
            return view('tasks.partials.task-list', compact('tasks'))->render();
        }

        $tasks = $query->get();
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }




    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|nullable|exists:categories,id',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in-progress,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $this->taskService->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }


    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $categories = Category::all();

        return view('tasks.edit', compact('task', 'categories'));
    }


    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|nullable|exists:categories,id',
            'description' => 'nullable|string',
            'due_date' => 'required|nullable|date',
            'status' => 'required|in:pending,in-progress,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $this->taskService->update($task, $validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }


    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $this->taskService->delete($task);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    

    

}
