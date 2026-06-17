<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webapp extends Model
{
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function envVariables() 
    {
        return $this->hasMany(EnvVariables::class);
    }

    public function dockerImage()
    {
        return $this->belongsTo(DockerImage::class);
    }

}
