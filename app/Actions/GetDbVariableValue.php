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
        $database = $variable->app->AppDatabase;
        $variableValueTrimed = trim($variable->value, '{}');
        if($variableValueTrimed == 'dbuser') {
            return $database->username;
        } 

        if($variableValueTrimed == 'dbname') {
            return $database->name;
        }

        if($variableValueTrimed == 'dbpassword') {
            return $database->password;
        }

        return '';
    }
}
