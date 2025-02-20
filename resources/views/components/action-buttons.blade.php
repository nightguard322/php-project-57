@props(["id", "options"])

@if($options['deleteAble'])
    <form method="POST" action="{{ route("{$options['model']}.destroy", $options['id']) }}" class="inline-flex">
        @method('DELETE')
        @csrf
        <a data-confirm="Вы уверены?" data-method="delete" 
        onclick="event.preventDefault(); this.closest('form').submit()"
        class="text-red-600 hover:text-red-900" href="{{ route("{$options['model']}.destroy", $options['id']) }}">Удалить</a>
    </form>
@endif
<a class="text-blue-600 hover:text-blue-900" href="{{ route("{$options['model']}.edit", $options['id']) }}">Изменить</a>