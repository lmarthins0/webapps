<?php

namespace App\Actions;

use App\Models\AppVariable;

class GetDbVariableValue
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function execute(AppVariable $variable)
    {
        $database = $variable->App->AppDatabase;
        $variableName = $variable->imageVariable->name;
        $variableNameTrimed = trim($variableName, '{}');
        if($variableNameTrimed == 'dbuser') {
            return $database->user;
        } 

        if($variableNameTrimed == 'dbname') {
            return $database->name;
        }

        if($variableNameTrimed == 'dbpassword') {
            return $database->password;
        }

        return '';
    }
}
