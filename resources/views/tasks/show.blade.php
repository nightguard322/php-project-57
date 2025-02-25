<x-app-layout>
    <x-header>Просмотр задачи: {{ $task->name }}
        <a href="{{ route('tasks.edit', $task) }}">⚙</a>
    </x-header>
    <div>
        <p>Имя: {{ $task->name }}</p>
        <p>Статус: {{ $task->status->name }}</p>
        <p>Описание: {{ $task->description }}</p>
        <p>Метки:</p>
        <div>Тут метки</div>
    </div>
</x-app-layout>