<?php

namespace App\Helpers;

class UrlHelper
{
    public static function linkToVision(string $path): string {
        return config('app.vision_url') . $path;
    }

    public static function linkToSocial(string $socialmedia = 'facebook'): string {
        return config('social.' . $socialmedia);
    }
}
