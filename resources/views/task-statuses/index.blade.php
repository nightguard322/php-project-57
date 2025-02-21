    <x-app-layout>
        <div class="grid col-span-full">
            <x-header>Статусы</x-header>
            @auth
                <div>
                    <x-blue-button :href="route('task-statuses.create')">Создать статус</x-blue-button>
                </div>
            @endAuth
            <x-table-child :headers="['ID', 'Имя', 'Дата создания']" 
            :rows="$statuses->toArray()" 
            model="task-statuses"/>
        </div>
    </x-app-layout>

