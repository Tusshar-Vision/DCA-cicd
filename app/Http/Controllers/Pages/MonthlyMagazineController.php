<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonthlyMagazineController extends Controller
{
    public function __construct()
    {}

    public function index() {

        return View('pages.monthly-magazine', [

        ]);
    }

    public function archive() {

        return View('pages.archives.monthly-magazine', [
            "title" => "Monthly Magazine Archives"
        ]);
    }
}
