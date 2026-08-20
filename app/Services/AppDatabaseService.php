<?php

namespace App\Services;

use App\Models\AppDatabase;
use App\Models\Webapp;

class AppDatabaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function getAppDatabase() {}

    public function storeDatabaseData(Webapp $webapp, string $password): AppDatabase
    {
        $appDatabase = new AppDatabase();

        $appDatabase->name = $webapp->name;
        $appDatabase->username = $webapp->name;
        $appDatabase->password = $password;
        $appDatabase->app_id = $webapp->id;

        $appDatabase->save();

        return $appDatabase;
    }

    public function updateDatabasePassword(AppDatabase $appDatabase, string $new_password): AppDatabase
    {
        $appDatabase->password = $new_password;
        $appDatabase->save();

        return $appDatabase;
    }
}
