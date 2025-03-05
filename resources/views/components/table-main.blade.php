@props(['entities', 'headers', 'links'])

<table class="mt-4">
    <thead class="border-b-2 border-solid border-black text-left">
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
            @Auth
                <th>Действия</th>
            @endAuth
        </tr>
    </thead>
    <tbody>
        @foreach($entities as $row)
            <tr>
                @foreach($row as $key => $cell)
                    @if ($key === 'link')
                        <td>
                            <a href="{{ $links[$row['id']]['show'] }}">{{ $cell }}</a>
                        </td>
                    @else
                        <td>{{ $cell }} </td>
                    @endif
                @endforeach
                @Auth
                    <td>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ $links[$row['id']['edit']] }}">Изменить</a>
                    </td>
                @endAuth
            </tr>
        @endforeach
    </tbody>
</table>
