<x-app-layout>
    <form method="POST" action="{{ route('task-statuses.store') }}">
        @csrf
        <x-header>Создать статус</x-header>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <input id="name" class="rounded border-gray-300 w-1\/3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4 w-1\/3">
            <input class="mr-2 px-4 py-2 bg-blue-500 text-white rounded font-bold text-white-700 dark:text-blue-300 hover:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:bg-blue-100 dark:focus:bg-blue-800 transition duration-150 ease-in-out" type="submit" value="Создать">
        </div>
            
        </div>
    </form>
</x-app-layout>