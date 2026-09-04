<?php

namespace App\Observers;

use App\Actions\DeleteAppVariablesAction;
use App\Actions\StoreAppVariablesOnImageSelection;
use App\Models\Webapp;
use App\Services\DockerImageService;

class WebappObserver
{
    public function updating(Webapp $webapp)
    {
        $newImageId = $webapp->image_id;
        $oldImageId = $webapp->getOriginal('image_id');

        if ($oldImageId != $newImageId) {
            DeleteAppVariablesAction::handle($webapp);

            $image = (new DockerImageService())->getImageById($newImageId);
            foreach ($image->imageVariables as $variable) {
                StoreAppVariablesOnImageSelection::execute($webapp, $variable);
            }
        }

        return;
    }
}
