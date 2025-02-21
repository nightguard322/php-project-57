@props(['headers','rows', 'model'])

<table class="mt-4">
    @include('partials.header');
    <tbody>
        @foreach($rows as $row)
            <tr>
                @foreach($row as $cell)
                    @if($cell === $row['Имя'])
                        <td><a href="{{ route("{$model}.edit", $row['id']) }}">{{ $cell }}</a></td>
                    @endif
                    <td>{{ $cell }}</td>
                @endforeach
                @Auth
                    <td>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ route("{$model}.edit", $row['id']) }}">Изменить</a>
                    </td>
                @endAuth
            </tr>
        @endforeach
    </tbody>
</table>
