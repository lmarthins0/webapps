<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webapp extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apps';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appVariables()
    {
        return $this->hasMany(AppVariable::class, 'app_id', 'id');
    }

    public function dockerImage()
    {
        return $this->belongsTo(DockerImage::class, 'image_id', 'id');
    }
}
