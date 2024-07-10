<?php

namespace App\Providers;

use Publiux\laravelcdn\Providers\AwsS3Provider;
use Symfony\Component\Console\Output\ConsoleOutput;
use Publiux\laravelcdn\Validators\Contracts\ProviderValidatorInterface;
use Publiux\laravelcdn\Contracts\CdnHelperInterface;

class CdnAwsS3Provider extends AwsS3Provider
{
    public function __construct(
        ConsoleOutput $console,
        ProviderValidatorInterface $provider_validator,
        CdnHelperInterface $cdn_helper
    ) {
        parent::__construct($console, $provider_validator, $cdn_helper);
    }

    /**
     * Override the getFilesAlreadyOnBucket method
     *
     * @param Collection $assets
     * @return mixed
     */
    protected function getFilesAlreadyOnBucket($assets)
    {
        $filesOnAWS = new Collection([]);

        $params = ['Bucket' => $this->getBucket()];
        do {
            $files = $this->s3_client->listObjectsV2($params);
            $params['ContinuationToken'] = $files->get('NextContinuationToken');

            $contents = $files->get('Contents');
            if (is_array($contents) || is_object($contents)) {
                foreach ($contents as $file) {
                    $a = [
                        'Key' => $file['Key'],
                        "LastModified" => $file['LastModified']->getTimestamp(),
                        'Size' => intval($file['Size'])
                    ];
                    $filesOnAWS->put($file['Key'], $a);
                }
            }
        } while ($files->get('IsTruncated'));

        if ($filesOnAWS->isEmpty()) {
            //no files on bucket. lets upload everything found.
            return $assets;
        }

        return $assets->filter(function ($file) use (&$filesOnAWS) {
            $fileOnAWS = $filesOnAWS->get(str_replace('\\', '/', $file->getPathName()));

            dd($fileOnAWS);

            //select to upload files that are different in size AND last modified time.
            return $file->getMTime() !== $fileOnAWS['LastModified'] && $file->getSize() !== $fileOnAWS['Size'];
        });
    }
}
