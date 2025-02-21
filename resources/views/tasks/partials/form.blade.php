<div>
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
</div>
<div>
    {{ html()->label('Описание', 'description') }}
    {{ html()->textarea('description') }}
</div>
<div>
    {{ html()->label('Статус', 'status') }}
    {{ html()->select('status_id', [$task['statuses']]) }}
</div>
<div>
    {{ html()->label('Исполнитель', 'status') }}
    {{ html()->select('status_id', [$task['users']]) }}
</div>
<div>
    {{ html()->label('Исполнитель', 'status') }}
    {{ html()->select('status_id', [$task['users']]) }}
</div>




