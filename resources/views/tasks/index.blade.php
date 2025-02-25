<x-app-layout>
    <div class="grid col-span-full">
        <x-header>Задачи</x-header>
            <a href="#">Статус</a>
            <a href="#">Автор</a>
            <a href="#">Исполнтиель</a>
                <x-blue-button :href="$entities['meta']['createRoute']">Применить</x-blue-button>
            </div>
            @auth
                <div>
                    <x-blue-button :href="$entities['meta']['createRoute']">Создать задачу</x-blue-button>
                </div>
            @endauth
            <x-table-main :entities="$entities" :links="$links"/>
    </div>
</x-app-layout>