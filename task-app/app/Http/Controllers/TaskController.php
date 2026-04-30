<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $tasks = $user->tasks()->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->tasks()->create([
            'title' => $request->title,
            'is_done' => false,
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        /** @var User $user */
        $user = auth()->user();

        $task = $user->tasks()->findOrFail($id);

        $task->update([
            'is_done' => !$task->is_done,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        /** @var User $user */
        $user = auth()->user();

        $user->tasks()->findOrFail($id)->delete();

        return redirect()->back();
    }
}