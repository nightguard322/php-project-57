@props(["id", "deleteAble"])

@if($deleteAble)
    <form method="POST" action="{{ route('task-statuses.destroy', $id) }}" class="inline-flex">
        @method('DELETE')
        @csrf
        <a data-confirm="Вы уверены?" data-method="delete" 
        onclick="event.preventDefault(); this.closest('form').submit()"
        class="text-red-600 hover:text-red-900" href="{{ route('task-statuses.destroy', $id) }}">Удалить</a>
    </form>
@endif
<a class="text-blue-600 hover:text-blue-900" href="{{ route('task-statuses.edit', $id) }}">Изменить</a>