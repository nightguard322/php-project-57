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