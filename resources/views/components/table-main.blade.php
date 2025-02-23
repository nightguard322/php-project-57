@props(['data'])

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
        @foreach($data['data'] as $row)
            <tr>
                @foreach($row as $key => $cell)
                    @if ($key === 'link')
                        continue;
                    @endif
                    { $slot }
                @endforeach
                @Auth
                    <td>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ $data['link'] }}">Изменить</a>
                    </td>
                @endAuth
            </tr>
        @endforeach
    </tbody>
</table>
