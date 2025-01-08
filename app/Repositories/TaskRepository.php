<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Task::all();
    }

    /**
     * Store a new task.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data)
    {
        return Task::create($data);
    }
}
