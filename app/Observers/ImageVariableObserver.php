<?php

namespace App\Observers;

use App\Models\ImageVariable;
use App\Models\AppVariable;

class ImageVariableObserver
{
    /**
     * Handle the ImageVariable "created" event.
     */
    public function created(ImageVariable $imageVariable): void
    {
        $apps = $imageVariable->image->apps;
        foreach($apps as $app):
            AppVariable::create([
            'image_variable_id' => $imageVariable->id,
            'app_id' => $app->id,
            'value' => null
        ]);
        endforeach;
    }

    /**
     * Handle the ImageVariable "updated" event.
     */
    public function updated(ImageVariable $imageVariable): void
    {
        //
    }

    /**
     * Handle the ImageVariable "deleted" event.
     */
    public function deleted(ImageVariable $imageVariable): void
    {
        //
    }

    /**
     * Handle the ImageVariable "restored" event.
     */
    public function restored(ImageVariable $imageVariable): void
    {
        //
    }

    /**
     * Handle the ImageVariable "force deleted" event.
     */
    public function forceDeleted(ImageVariable $imageVariable): void
    {
        //
    }
}
