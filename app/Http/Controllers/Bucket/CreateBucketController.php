<?php

namespace App\Http\Controllers\Bucket;

use App\Http\Controllers\Controller;
use Aws\S3\S3Client;
use App\Services\WebappService;

class CreateBucketController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $appId)
    {
        $webapp = (new WebappService())->getWebappById($appId);
        $siteName = explode('.', $webapp->dominio)[0];

        $s3Client = new S3Client([
            'version' => 'latest',
            'region'=> 'us-east-1',
            'endpoint' => env('RUSTFS_URL'), // URL interna do Docker
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => env('RUSTFS_KEY'),
                'secret' => env('RUSTFS_SECRET'),
            ],
        ]);

        try {

            $s3Client->createBucket([
                'Bucket' => $siteName,
            ]);

            $webapp->bucket_name = $siteName;
            $webapp->save();

            return redirect("/webapps/{$webapp->id}");
        } catch (\Throwable $th) {
            return "Erro: ". $th;
        }
    }
}
