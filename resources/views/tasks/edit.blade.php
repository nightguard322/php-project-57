<x-app-layout>
    @php dd($taskData) @endphp
    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->open() }}
    @include('tasks.partials.form');
    {{ html()->submit('Обновить') }}
    {{ html()->form()->close() }}
</x-app-layout>