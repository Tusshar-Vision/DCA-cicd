<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocalizationController extends Controller
{
    public function changeLang(Request $request)
    {
        session()->put('locale', $request->lang);
        return redirect()->route('home');
    }
}
