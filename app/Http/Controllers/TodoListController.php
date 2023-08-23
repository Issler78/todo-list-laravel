<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public $todo;

    public function __construct()
    {
        $this->todo = Task::all();
    }
    
    public function render()
    {
        return view('todo-list', ['tasks' => $this->todo]);
    }

    public function store(Request $request)
    {
        $listItem = new Task();
        $validate = $request->validate([
            'name' => 'required'
        ],
        [
            'name.required' => 'Preencha o nome da tarefa.'
        ]);

        if($validate)
        {
            Task::create([
                'name' => $request->input('name')
            ]);

            return back();
        }
        
        return redirect()->back()->withErrors($validate)->withInput();
    }

    public function destroy(string $id)
    {
        Task::find($id)->delete();
        return back();
    }

    public function mark($id)
    {
        $item = Task::find($id);
        $item->isCompleted = !$item->isCompleted;
        $item->save();

        return redirect()->back();
    }
}
