<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTaskIds = TaskStatus::all()->pluck('id');
        $creatorIds = User::all()->pluck('id');

        $data = [
            [
                'name' => 'Исправить ошибку в какой-нибудь строке',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            ],
            [
                'name' => '	Допилить дизайн главной страницы',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            ],
            [
                'name' => 'Отрефакторить авторизацию',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            ],
            [
                'name' => '	Доработать команду подготовки БД',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            ],
            [
                'name' => 'Пофиксить вон ту кнопку',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            ],
            [
                'name' => 'Исправить поиск',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
            ],
        ];
        $prepared = array_map(
            fn($task) => 
                array_merge(
                    $task, 
                    [
                    'status_id' => $statusTaskIds->random(), 
                    'created_by_id' => $creatorIds->random(),
                    'assigned_to_id' => $creatorIds->random(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                    ]
                ),
            $data
        );
        Task::insert($prepared);
    }
}
