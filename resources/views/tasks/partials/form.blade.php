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
    {{ html()->select('status_id', $statuses, $task->status->name) }}
</div>
<div>
    {{ html()->label('Исполнитель', 'status') }}
    {{ html()->select('assigned_to_id', $users, $task->assignee->name) }}
</div>




