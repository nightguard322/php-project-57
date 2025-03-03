<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view::composer('tasks.index', function($view) {
            $tasks = $view->getData()['tasks'];
            $links = $view->getData()['links'];

            $tasks->map(function($task) use ($links) {
                $task->name = "<a href={$links['show']}>{$task->name}</a>";
                return $task;
            });
        });
        view::with('tasks', 'tasks');
    }
}
