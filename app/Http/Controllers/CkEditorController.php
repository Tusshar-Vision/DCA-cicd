<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CkEditorController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Store the file on the S3 disk
            $path = $file->store('uploads', 's3_public');

            // Generate a URL to the stored file
            $url = Storage::disk('s3_public')->url($path);

            return response()->json([
                'uploaded' => true,
                'url' => $url // Return the URL to the uploaded file
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'File upload failed.']
        ]);
    }
}

