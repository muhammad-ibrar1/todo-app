<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        return response()->json($this->taskRepository->getAll());
    }

    public function store(Request $request)
    {
        // we can make seprate request for validation as well.
        $taskData = $request->validate([
            'task' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $newTask = $this->taskRepository->create($taskData);

        return response()->json($newTask, 201);
    }
}
