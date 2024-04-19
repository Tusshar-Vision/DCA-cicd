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
        $name = $media->name . '.' . $media->extension;

        // Generate a pre-signed URL with a temporary access token
        $temporaryUrl = $media->getTemporaryUrl(now()->add('minutes', 5));
        $response = \Http::get($temporaryUrl);

        return \response($response->body(), 200, [
           'Content-Type' => 'application/pdf',
           'Content-Disposition' => 'attachment;filename="' . $name . '"',
        ]);
    }

    public function viewFile(Media $media)
    {
        return response()->redirectTo($media->getTemporaryUrl(now()->add('minutes', 120)));
    }
}
