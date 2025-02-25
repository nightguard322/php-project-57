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
    {{ html()->select('status_id', [$task['status']]) }}
</div>
<div>
    {{ html()->label('Создатель', 'status') }}
    {{ html()->select('status_id', [$users]) }}
</div>
<div>
    {{ html()->label('Исполнитель', 'status') }}
    {{ html()->select('status_id', [$users]) }}
</div>




