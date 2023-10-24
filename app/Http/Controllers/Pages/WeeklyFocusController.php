<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeeklyFocusController extends Controller
{
    public function __construct()
    {}

    public function index() {

        return View('pages.weekly-focus', [

        ]);
    }

    public function archive() {

        return View('pages.archives.weekly-focus', [
            "title" => "Weekly Focus Archive"
        ]);
    }
}
