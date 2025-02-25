<x-app-layout>
    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task['id']))->open() }}
    @include('tasks.partials.form')
    {{ html()->submit('Обновить') }}
    {{ html()->form()->close() }}
</x-app-layout>