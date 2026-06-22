<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageVariable extends Model
{
    protected $fillable = ['name', 'image_id'];

    public function image()
    {
        return $this->belongsTo(DockerImage::class, 'image_id', 'id');
    }

    public function appVariables() 
    {
        return $this->hasMany(AppVariable::class);
    }
}
