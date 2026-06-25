<?php

namespace App\Services;

use App\Models\Bucket;
use App\Models\Webapp;

class BucketService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function storeBucket(Webapp $webapp, array $requestData): Bucket
    {
        $bucket = Bucket::create([
            'name' => $requestData['name'],
            'key' => $requestData['key'],
            'secret' => $requestData['secret']
        ]);

        return $bucket;
    }

    public function deleteBucket(Bucket $bucket)
    {
        
    }
}
