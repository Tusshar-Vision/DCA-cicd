<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Mains365Controller extends Controller
{
    public function __construct()
    {}

    public function index() {

        return View('pages.mains-365', [

        ]);
    }
}
