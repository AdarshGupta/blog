<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
	public function index()
	{
		$tasks = Task::incomplete();
		return view('tasks.index', compact('tasks'));
	}
    
    public function show(Task $task)	// The variable name $task should match with wildcard in the route in web.php or else it won't work. It does autom. Task::find($task)
    {
    	return $task;
    	return view('tasks.show', compact('task'));
    }
}
