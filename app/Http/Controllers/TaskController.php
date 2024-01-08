<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,Task $task)
    {
        $user = Auth::user();
        $userTasks = $user->tasks()->get();
        $allCount = $userTasks->count();
        $open = $userTasks->where('status', false)->count();
        $completed = $userTasks->where('status', true)->count();
        // dd(count($userTasks));
        return view('dashboard',compact('userTasks','allCount','open','completed'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $user = Auth::user();
        $user->tasks()->create([
            'title' => $validated['title'],
            'description' => trim($validated['description']),
        ]);
        return redirect()->back()->with('success', 'Task saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function updateStatus(Task $task)
    {
        $task->status = !$task->status;
        $task->completed_at = $task->status == false ? now() : null;
        $task->update();
        return redirect()->route('dashboard')->with('success', 'Task Status Updated successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('editTask',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $user = Auth::user();
        if ($task->user_id != $user->id) {
            return redirect()->back()->withErrors('msg', 'Cannot Update Task');
        }
        $task->title = $validated['title'];
        $task->description = trim($validated['description']);
        $task->update();
        return redirect()->route('dashboard')->with('success', 'Task Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $user = Auth::user();
        if ($task->user_id != $user->id) {
            return redirect()->back()->withErrors('msg', 'Cannot Update Task');
        }
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task Deleted successfully!');
    }
}
