<x-app-layout>
    <div class="grid col-span-full">
        <x-header>Задачи</x-header>
        <div>
            <a href="#">Статус</a>
            <a href="#">Автор</a>
            <a href="#">Исполнтиель</a>
            <x-blue-button :href="#">Применить</x-blue-button>
            @auth
                <x-blue-button :href="route('tasks/create')">Создать задачу</x-blue-button>
            @auth
            <x-table-content 
                :headers="['ID', 'Статус', 'Имя', 'Автор', 'Исполнитель', 'Дата создания']"
                :rows="$tasks->toArray()"
                :deleteAble="false"
            />
        </div>
    </div>
</x-app-layout>