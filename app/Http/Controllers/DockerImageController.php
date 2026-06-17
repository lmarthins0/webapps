<?php

namespace App\Http\Controllers;

use App\Http\Requests\DockerImageRequest;
use App\Http\Requests\DockerImageUpdateRequest;
use App\Models\DockerImage;
use App\Services\DockerImageService;

class DockerImageController extends Controller
{
    public function index()
    {
        $dockerImages = (new DockerImageService())->getAllDockerImages();
        return view('dockerimages.index', [
            'docker_images' => $dockerImages
        ]);
    }

    public function show(DockerImage $dockerimage)
    {
        return view('dockerimages.show', [
            'docker_image' => $dockerimage
        ]);
    }

    public function create()
    {
        return view('dockerimages.create');
    }

    public function store(DockerImageRequest $request)
    {
        $dockerImage = (new DockerImageService())->createDockerImage($request->validated());
        return redirect("/dockerimages/{$dockerImage->id}");
    }

    public function edit(DockerImage $dockerimage)
    {
        return view('dockerimages.edit', [
            'docker_image' => $dockerimage
        ]);
    }

    public function update(DockerImageUpdateRequest $request, DockerImage $dockerimage)
    {
        $dockerImage = (new DockerImageService())->updateDockerImage($dockerimage, $request->validated());
        return redirect("/dockerimages/{$dockerImage->id}");
    }

    public function destroy(DockerImage $dockerimage)
    {
        $deleted = (new DockerImageService())->destroyDockerImage($dockerimage);

        if($deleted) {
            return redirect("/dockerimages");
        }
    }
}
