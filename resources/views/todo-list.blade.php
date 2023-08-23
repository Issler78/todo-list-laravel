<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo List</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/todo-list.css') }}">
    </head>
    <body>
        <div class="card">
            <div class="row-title">
                <h2>Todo List</h2>
                <span class="material-icons">checklist</span>
            </div>
            <div class="row-input">
                <form action="{{ route('todo.store') }}" method="POST" class="form-new-task">
                @csrf
                    <input type="text" placeholder="Nome da tarefa" class="new-task-input" name="name">
                    <button type="submit" class="btn-add">ADD</button>
                </form>
                @error('name')
                <p id="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="list">
                @foreach($tasks as $task)
                <div class="row-list">
                    @if($task->isCompleted == false)
                    <form action="{{ route('todo.mark', ['id' => $task->id]) }}" method="POST">
                        @csrf
                        @method('patch')
                        <input type="checkbox" name="checked" class="check" onchange="this.form.submit()" {{ $task->isCompleted ? 'checked' : '' }}>
                        <p class="name-task">{{ $task->name }}</p>
                    </form>
                    <form action="{{ route('todo.destroy', ['id' => $task->id]) }}" method="post" class="row-item">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn-del"><span class="material-icons">clear</span></button>
                    </form>

                    @else
                    <form action="{{ route('todo.mark', ['id' => $task->id]) }}" method="POST">
                        @csrf
                        @method('patch')
                        <input type="checkbox" name="checked" class="check" onchange="this.form.submit()" {{ $task->isCompleted ? 'checked' : '' }}>
                        <p class="name-task" style="color: #bbb;"><del>{{ $task->name }}</del></p>
                    </form>
                    <form action="{{ route('todo.destroy', ['id' => $task->id]) }}" method="post" class="row-item">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn-del"><span class="material-icons">clear</span></button>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
