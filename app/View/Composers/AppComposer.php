<?php

namespace App\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view): void
    {
        $view->with('appSettings', [
            'github' => config('settings.github'),
        ]);
    }
}

