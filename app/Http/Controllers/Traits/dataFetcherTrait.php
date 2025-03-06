<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use App\Models\TaskStatus;

Trait dataFetcherTrait
{
    public function fetchUsersFields()
    {
        return User::all()->pluck('id', 'name');
    }

    public function fetchStatusesFields()
    {
        return TaskStatus::all()->pluck('id', 'name');
    }

    // public function prepareFormData()
    // {
    //     return (new TaskViewModel($task))->getFormData([
    //         'assignee' => $this->fetchUsersFields(),
    //         'status' => $this->fetchStatusesFields()
    //     ]);
    // }
}