<?php

namespace App\Helpers;

class URLHelper
{
    public function linkToVision(string $path): string {
        return config('app.vision_url') . $path;
    }

}
