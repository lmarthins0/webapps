<?php

namespace App\Services;

use App\Models\AppDatabase;
use App\Models\Webapp;

class AppDatabaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function getAppDatabase()
    {
        
    }

    public function storeDatabaseData(Webapp $webapp, array $requestData): AppDatabase
    {
        $appDatabase = AppDatabase::create([
            'name' => $requestData['name'],
            'username' => $requestData['name'],
            'password' => $requestData['password'],
            'app_id' => $webapp->id
        ]);
        return $appDatabase;
    }

    public function updateDatabasePassword(AppDatabase $appDatabase, array $requestData): AppDatabase
    {
        $appDatabase->password = $requestData['new_password'];
        $appDatabase->save();

        return $appDatabase;
    }
}
