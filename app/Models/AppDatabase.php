<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppDatabase extends Model
{
    protected $fillable = ['name', 'username', 'password'];

    public function App()
    {
        return $this->belongsTo(Webapp::class, 'app_id', 'id');
    }
}
