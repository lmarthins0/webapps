<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DockerImage extends Model
{
    protected $fillable = ['path', 'tag', 'env_variables'];
}
