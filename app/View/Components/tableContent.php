<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class tableContent extends Component
{
    private $headers;
    private $rows;
    private $actions;
    /**
     * Create a new component instance.
     */
    public function __construct(array $headers, array $rows, string $actions)
    {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->actions = $actions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-content');
    }

    public function getActionLinks($id, $deleteable = false)
    {
        $updateAction = "<a class=\"text-blue-600 hover:text-blue-900\" href=\"https://php-task-manager-ru.hexlet.app/task_statuses/'{$id}'/edit\">Изменить</a>";
        $deleteAction = "<a data-confirm=\"Вы уверены?\" data-method=\"delete\" class=\"text-red-600 hover:text-red-900\" href=\"https://php-task-manager-ru.hexlet.app/task_statuses/'{$id}'\">Удалить</a>";
        return $deleteable ? "{$updateAction}{$deleteAction}" : "{$updateAction}";
                
    }
}
