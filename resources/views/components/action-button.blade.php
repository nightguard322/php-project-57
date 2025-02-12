@props(['href'])
<a {{ $attributes->merge(['href' => $href, 'class' => 'ml-2 block px-4 py-2 bg-blue-500 text-white rounded font-bold text-white-700 dark:text-blue-300 hover:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:bg-blue-100 dark:focus:bg-blue-800 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>
