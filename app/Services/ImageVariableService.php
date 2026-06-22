<?php

namespace App\Services;

use App\Models\ImageVariable;

class ImageVariableService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getImageVariableById(string $variableId): ImageVariable
    {
        $variable = ImageVariable::find($variableId);
        return $variable;
    }

    public function storeVariable(string $imageId, array $requestData)
    {
        ImageVariable::create([
            'image_id' => $imageId,
            'name' => $requestData['name']
        ]);
    }

    public function updateVariable(ImageVariable $variable, array $requestData)
    {
        $variable->name = $requestData['name'];
        $variable->save();
    }
}
