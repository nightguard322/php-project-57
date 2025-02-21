@props(["id"])

<a class="text-blue-600 hover:text-blue-900" href="{{ route("{$model}.edit", $row->id) }}">Изменить</a>