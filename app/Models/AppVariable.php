<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppVariable extends Model
{
    protected $fillable = ['app_id', 'image_variable_id', 'value'];

    public function app()
    {
        return $this->belongsTo(Webapp::class);
    }

    public function imageVariable()
    {
        return $this->belongsTo(ImageVariable::class);
    }
}
