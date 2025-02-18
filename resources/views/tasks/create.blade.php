<x-app-layout>
    {{ html()->modelForm($task, 'POST', route(tasks.store))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
    {{ html()->label('Описание', 'description') }}
    {{ html()->textarea('description') }}
    {{ html()->label('Статус', 'status') }}
    {{ html()->select('status_id', [])}}

</x-app-layout>