<?php

namespace App\Actions;

use App\Models\AppVariable;
use App\Models\ImageVariable;
use App\Models\Webapp;

class StoreAppVariablesOnImageSelection
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function execute(Webapp $webapp, ImageVariable $imageVariable)
    {
        AppVariable::create([
            'image_variable_id' => $imageVariable->id,
            'app_id' => $webapp->id,
            'value' => null
        ]);
    }
}
