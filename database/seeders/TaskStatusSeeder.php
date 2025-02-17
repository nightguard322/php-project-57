<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'name' => 'новая',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'завершена',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'выполняется',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'в архиве',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        TaskStatus::insert($data);
    }
}
