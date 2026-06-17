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

    function getImageEnvVariables(string $docker_image_id) 
    {
        $raw_env_variables = DockerImage::find($docker_image_id, ['env_variables']);
        $env_variables = explode(',', $raw_env_variables->env_variables);
        return $env_variables;
    }

    function createDockerImage(array $dockerImageData)
    {
        $dockerImage = new DockerImage();
        $dockerImage->name = $dockerImageData['name'];
        $dockerImage->path = $dockerImageData['path'];
        $dockerImage->tag = $dockerImageData['tag'];
        $dockerImage->env_variables = $dockerImageData['env_variables'];
        $dockerImage->save();

        return $dockerImage;
    }

    function updateDockerImage(DockerImage $dockerImage, array $dockerImageData): DockerImage 
    {
        $dockerImage->update([
            'path' => $dockerImageData['path'],
            'tag' => $dockerImageData['tag'],
            'env_variables' => $dockerImageData['env_variables']
        ]);

        return $dockerImage;
    }

    function destroyDockerImage(DockerImage $dockerImage) 
    {
        $dockerImage->delete();

        return true;
    }
}