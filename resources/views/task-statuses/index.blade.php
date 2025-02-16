    <x-app-layout>
        <div class="grid col-span-full">
            <x-header>Статусы</x-header>
            @auth
                <div>
                    <x-blue-button :href="route('task-statuses.create')">Создать статус</x-blue-button>
                </div>
            @endAuth
            <x-table-content :headers="['ID', 'Имя', 'Дата создания']" :rows="$statuses->toArray()" :deleteAble="true"/>
        </div>
    </x-app-layout>

