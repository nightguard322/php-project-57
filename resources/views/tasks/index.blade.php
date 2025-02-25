<x-app-layout>
    <div class="grid col-span-full">
        <x-header>Задачи</x-header>
            <a href="#">Статус</a>
            <a href="#">Автор</a>
            <a href="#">Исполнтиель</a>
            <div>
                <x-blue-button :href="$tasks['meta']['createRoute']">Применить</x-blue-button>
            </div>
            @auth
                <div>
                    <x-blue-button :href="$tasks['meta']['createRoute']">Создать задачу</x-blue-button>
                </div>
            @endauth
            @php dd($tasks); @endphp
            <x-table-main :entities="$tasks" :links="$links"/>
    </div>
</x-app-layout>