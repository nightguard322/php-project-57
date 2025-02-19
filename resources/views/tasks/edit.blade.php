<x-app-layout>
    {{ html()->modelForm($taskData['task'], 'PATCH', route(tasks.update))->open() }}
    @include('partials.form');
    {{ html()->submit('Обновить') }}
    {{ html()->closeForm() }}
</x-app-layout>