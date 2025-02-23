
@if ($key === 'name')
    <td>
        @if($link)
            <a href="{{ $link }}">{{ $cell }}</a>
        @else
            {{ $cell }}
        @endif
    </td>
@else
    <x-table-cell :cell="$cell"/>
@endif

