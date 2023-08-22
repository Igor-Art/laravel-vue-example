<?php

namespace App\Console\Commands\Dev;

use Symfony\Component\Console\Attribute\AsCommand;
use Illuminate\Foundation\Console\KeyGenerateCommand as BaseCommand;

/**
 * TODO Important
 * Overriding the default behavior for "key:generate".
 * This change is required for a quick start with docker (current demo only).
 * Do not use in working projects.
 */

#[AsCommand(name: 'key:generate')]
class KeyGenerateCommand extends BaseCommand
{
    protected $description = 'Set the application key only is empty';

    protected function setKeyInEnvironmentFile($key)
    {
        if ($this->laravel['config']['app.key'] && (!$this->hasOption('force') || !$this->option('force'))) {
            return false;
        }

        return parent::setKeyInEnvironmentFile($key);
    }
}
