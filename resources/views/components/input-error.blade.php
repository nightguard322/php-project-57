@props(['messages'])

@if ($messages)
    <p class='text-sm text-red-600'>Упс! Что-то пошло не так:</p>
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
