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
                :headers="['ID', 'Статус', 'Имя', 'Автор', 'Исполнитель', 'Дата создания']"
                :rows="$tasks"
                model="tasks"
            />
    </div>
</x-app-layout>