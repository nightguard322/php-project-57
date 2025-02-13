    <x-app-layout>
        <div class="grid col-span-full">
            <x-header>Статусы</x-header>
            <div>
                <x-action-button :href="route('task-statuses.create')">Создать статус</x-action-button>
            </div>
            <x-table-content :headers="['ID', 'Имя', 'Дата', 'Действия']" :rows="$statusList->toArray()"/>
        </div>
    </x-app-layout>

