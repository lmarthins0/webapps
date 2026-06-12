<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvVariables extends Model
{
    protected $fillable = ['name', 'value', 'webapp_id'];
}
