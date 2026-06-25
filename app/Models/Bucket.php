<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $fillable = ['name', 'key', 'secret'];

    public function App()
    {
        return $this->belongsTo(Webapp::class, 'app_id', 'id');
    }
}
