<?php

namespace App\Http\Controllers;

use App\Models\Webapp;
use App\Services\DockerImageService;

class EditWebappImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Webapp $webapp)
    {
        $dockerImages = (new DockerImageService())->getAllDockerImages();
        return view('webapps.dockerimage', [
            'webapp' => $webapp,
            'docker_images' => $dockerImages
        ]);
    }
}
