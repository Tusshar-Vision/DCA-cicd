<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('public/uploads'); // Adjust the path as necessary

            return response()->json([
                'uploaded' => true,
                'url' => Storage::url($path)
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'File upload failed.']
        ]);
    }
}

