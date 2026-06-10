<?php

namespace App\Http\Controllers\Bucket;

use App\Http\Controllers\Controller;
use App\Services\WebappService;
use Aws\S3\S3Client;

class DeleteBucketController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $appId)
    {
        $webapp = (new WebappService())->getWebappById($appId);

        $s3Client = new S3Client([
            'version'                 => 'latest',
            'region'                  => 'us-east-1',
            'endpoint'                => env('RUSTFS_URL'), // URL interna do Docker
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => env('RUSTFS_KEY'),
                'secret' => env('RUSTFS_SECRET'),
            ],
        ]);

        try {
            $s3Client->deleteBucket([
                'Bucket' => $webapp->dominio
            ]);

            $webapp->bucket_name = null;
            $webapp->save();

            return redirect("/webapps/{$webapp->id}");
        } catch (\Throwable $th) {
            return "Erro.";
        }
    }
}
