@props(['headers','rows','options'])

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

        @foreach($rows as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
                @Auth
                    <td>
                        <x-action-buttons :options="array_merge($options, ['id' => $row['id']])"/>
                    </td>
                @endAuth
            </tr>
        @endforeach
    </tbody>
</table>
