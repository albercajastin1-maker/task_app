<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Georgia', serif;
            background: #f7f6f2;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 3rem 1rem;
            color: #1a1a18;
        }

        .container {
            width: 100%;
            max-width: 480px;
        }

        h1 {
            font-size: 1.6rem;
            font-weight: normal;
            letter-spacing: -0.02em;
            margin-bottom: 2rem;
            color: #1a1a18;
        }

        .add-form {
            display: flex;
            gap: 8px;
            margin-bottom: 2rem;
        }

        .add-form input[type="text"] {
            flex: 1;
            padding: 10px 14px;
            border: 1px solid #d4d2ca;
            border-radius: 8px;
            background: #fff;
            font-size: 0.95rem;
            font-family: inherit;
            color: #1a1a18;
            outline: none;
            transition: border-color 0.15s;
        }

        .add-form input[type="text"]:focus {
            border-color: #888780;
        }

        .add-form button {
            padding: 10px 18px;
            background: #1a1a18;
            color: #f7f6f2;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .add-form button:hover { opacity: 0.8; }

        .divider {
            border: none;
            border-top: 1px solid #d4d2ca;
            margin-bottom: 1.25rem;
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .task-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: #fff;
            border: 1px solid #d4d2ca;
            border-radius: 8px;
            transition: border-color 0.15s;
        }

        .task-item:hover { border-color: #888780; }

        .task-item.done .task-title {
            text-decoration: line-through;
            color: #b4b2a9;
        }

        .toggle-btn {
            width: 28px;
            height: 28px;
            border: 1.5px solid #d4d2ca;
            border-radius: 50%;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
            transition: border-color 0.15s, background 0.15s;
            padding: 0;
        }

        .toggle-btn:hover { border-color: #5f5e5a; }

        .task-item.done .toggle-btn {
            background: #1a1a18;
            border-color: #1a1a18;
            color: #f7f6f2;
        }

        .task-title {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .delete-btn {
            background: transparent;
            border: none;
            color: #b4b2a9;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            padding: 2px 4px;
            border-radius: 4px;
            transition: color 0.15s;
        }

        .delete-btn:hover { color: #d85a30; }
    </style>
</head>
<body>

<div class="container">
    <h1>Task Manager</h1>

    <form method="POST" action="/tasks" class="add-form">
        @csrf
        <input type="text" name="title" placeholder="Add a new task…" required>
        <button type="submit">Add</button>
    </form>

    <hr class="divider">

    <div class="task-list">
        @foreach($tasks as $task)
            <div class="task-item {{ $task->is_done ? 'done' : '' }}">

                {{-- Toggle --}}
                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('PATCH')
                    <button class="toggle-btn" type="submit" title="Toggle done">
                        {{ $task->is_done ? '✓' : '' }}
                    </button>
                </form>

                {{-- Title --}}
                <span class="task-title">{{ $task->title }}</span>

                {{-- Delete --}}
                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" type="submit" title="Delete">×</button>
                </form>

            </div>
        @endforeach
    </div>
</div>

</body>
</html>