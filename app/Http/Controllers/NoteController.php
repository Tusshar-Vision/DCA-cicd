<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function addNote(Request $request)
    {
        $params = $request->all();
        logger("params", [$params]);
    }
}
