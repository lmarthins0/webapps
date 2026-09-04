<?php

namespace App\Actions;

use App\Models\Webapp;

class DeleteAppVariablesAction
{
    /**
     * Create a new class instance.
     */
    static public function handle(Webapp $webapp)
    {
        foreach ($webapp->appVariables as $appVariable):
            $appVariable->delete();
        endforeach;
    }
}
