<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function renderImage($filename)
    {
        $path = storage_path('app/public/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function download(Media $media)
    {
        // Get the URL of the media item from the S3 bucket
        $url = $media->getFullUrl();
        $name = $media->name . '.' . $media->extension;

        // Generate a pre-signed URL with a temporary access token
        $temporaryUrl = \Storage::disk('s3')->temporaryUrl(
            $media->getPath(),
            now()->addMinutes(5) // Adjust the expiration time as needed
        );

        // Create a StreamedResponse to stream the file content to the user
        return response()->streamDownload(function () use ($temporaryUrl) {
            $fileStream = fopen($temporaryUrl, 'r');

            // Stream the file content to the client
            fpassthru($fileStream);

            // Close the file stream
            fclose($fileStream);
        }, $name);
    }

    public function viewFile(Media $media)
    {
        return response()->redirectTo($media->getTemporaryUrl(now()->add('minutes', 120)));
    }
}
