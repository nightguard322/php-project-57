@props(['headers','rows', 'actions'])

<table class="mt-4">
    <thead class="border-b-2 border-solid border-black text-left">
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
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
                        
                    </td>
                @endAuth
            </tr>
        @endforeach
    </tbody>
</table>
