<x-app-layout>
    {{ html()->modelForm($taskData['task'], 'POST', route(tasks.store))->open() }}
    @include('partials.form');
    {{ html()->submit('Создать') }}
    {{ html()->closeForm() }}
</x-app-layout>