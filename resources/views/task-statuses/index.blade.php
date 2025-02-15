    <x-app-layout>
        <div class="grid col-span-full">
            <x-header>Статусы</x-header>
            <div>
                <x-action-button :href="route('task-statuses.create')">Создать статус</x-action-button>
            </div>
            <x-table-content 
                :headers="['ID', 'Имя', 'Дата', 'Действия']" 
                :rows="$statusList->toArray()" 
                :update="function($id, $removable = false) {
                    return "<a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="https://php-task-manager-ru.hexlet.app/task_statuses/{$id}">Удалить</a>
                    <a class="text-blue-600 hover:text-blue-900" href="https://php-task-manager-ru.hexlet.app/task_statuses/{$id}/edit">Изменить</a>";
                ";
                }
            />
        </div>
    </x-app-layout>

