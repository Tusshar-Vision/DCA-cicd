<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsTodayController extends Controller
{
    public function __construct()
    {}

    public function index() {

        return View('pages.news-today', [

        ]);
    }

    public function archive() {

        return View('pages.archives.daily-news', [
            "title" => "Daily News Archive"
        ]);
    }
}
