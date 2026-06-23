<?php

namespace App\Actions;

use App\Models\DockerImage;
use App\Models\Webapp;
use Symfony\Component\Yaml\Yaml;

class GenerateComposeYml
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function execute(DockerImage $dockerImage, Webapp $webapp)
    {
        $env_variables = $webapp->appVariables;
        $environment = [];
        foreach ($env_variables as $env_variable):
            $environment[$env_variable->imageVariable->name] = $env_variable->value;
        endforeach;

         $composeArray = [
            'services' => [
                'app' => [
                    'image' => "{$dockerImage->path}:{$dockerImage->tag}",
                    'restart' => 'unless-stopped',
                    'ports' => ['8888:80'],
                    'environment' => $environment,
                    'entrypoint' => [
                        'sh',
                        '-c',
                        'php artisan migrate --force && exec apache2-foreground'
                    ]
                ]
            ]
        ];

        $composeYaml = Yaml::dump($composeArray, 4, 2);
        $composeYaml = str_replace("'-c'", "-c", $composeYaml);

        return $composeYaml;
    }
}
