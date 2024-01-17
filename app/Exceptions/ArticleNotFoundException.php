<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(): void
    {
        Log::error('No Published Initiative got returned, received null instead.');
    }

    /**
     * Render the exception into an HTTP response.
     *
     */
    public function render(Request $request)
    {
        return view('errors.404');
    }
}