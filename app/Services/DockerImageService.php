<?php

namespace App\Services;

use App\Models\DockerImage;

class DockerImageService
{
    function getAllDockerImages()
    {
        $dockerImages = DockerImage::all();
        return $dockerImages;
    }

    function getImageById(string $docker_image_id): DockerImage
    {
        $dockerImage = DockerImage::find($docker_image_id);
        return $dockerImage;
    }

    function getImageVariables(string $image_id)
    {
        $image = $this->getImageById($image_id);
        $variables = [];
        foreach($image->imageVariables as $variable) {
            $variables[] = [
                'name' => $variable->name,
                'value' => null
            ];
        }
        return $variables;
    }

    function createDockerImage(array $dockerImageData)
    {
        $dockerImage = new DockerImage();
        $dockerImage->name = $dockerImageData['name'];
        $dockerImage->path = $dockerImageData['path'];
        $dockerImage->save();

        return $dockerImage;
    }

    function updateDockerImage(DockerImage $dockerImage, array $dockerImageData): DockerImage
    {
        $dockerImage->update([
            'path' => $dockerImageData['path']
        ]);

        return $dockerImage;
    }


    function destroyDockerImage(DockerImage $dockerImage)
    {
        $dockerImage->delete();

        return true;
    }

    function storeImageVariable() {

    }
}
