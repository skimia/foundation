<?php

namespace Skimia\Foundation\Providers\Traits;

use Illuminate\Support\ServiceProvider;

trait CommandLoaderTrait
{
    /**
     * Register the commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        ensure_trait_used_in_subclass_of_or_fail(self::class, $this, ServiceProvider::class);

        foreach (array_keys($this->commands) as $command) {
            $method = "register{$command}Command";
            call_user_func_array([$this, $method], []);
        }
        $this->commands(array_values($this->commands));
    }
}
