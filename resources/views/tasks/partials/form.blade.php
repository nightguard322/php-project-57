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
    @php dd($User); @endphp
    {{ html()->select('status_id', [$User['all']], $User['current']) }}
</div>
<div>
    {{ html()->label('Исполнитель', 'status') }}
    {{ html()->select('assigned_to_id', [$User['all']], $User['current']) }}
</div>




