<?php

namespace App\Http\Controllers\Dockerimage;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageVariableRequest;
use App\Models\ImageVariable;
use App\Services\ImageVariableService;
use Illuminate\Http\Request;

class ImageVariableController extends Controller
{
    public function update(ImageVariable $variable, StoreImageVariableRequest $request)
    {
        $imageId = $variable->image->id;
        
        (new ImageVariableService())->updateVariable($variable, $request->validated());

        return redirect("/dockerimages/{$imageId}");
    }

    public function destroy(string $variableId) 
    {
        $variable = (new ImageVariableService())->getImageVariableById($variableId);
        $imageId = $variable->image->id;
        $variable->delete();

        return redirect("/dockerimages/{$imageId}");
    }
}
