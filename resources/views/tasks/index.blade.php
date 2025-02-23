<x-app-layout>
    <div class="grid col-span-full">
        <x-header>Задачи</x-header>
            <a href="#">Статус</a>
            <a href="#">Автор</a>
            <a href="#">Исполнтиель</a>
            <div>
                <x-blue-button :href="route('tasks.create')">Применить</x-blue-button>
            </div>
            @auth
                <div>
                    <x-blue-button :href="route('tasks.create')">Создать задачу</x-blue-button>
                </div>
            @endauth
            <x-table-main
                :tasks="$tasks"
            />
    </div>
</x-app-layout>