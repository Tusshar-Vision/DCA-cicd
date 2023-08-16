<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Initiative;
use Illuminate\Http\Request;

class InitiativeController extends Controller
{
    public function index() {
        $initiatives = Initiative::get(['name', 'description', 'path']);    
        return view('index')->with('initiatives', $initiatives);
    }

    public function getArticles($initiative) {

        $initiativePath = '/' . $initiative;
        $initiativeID = Initiative::where('path', '=', $initiativePath)->get('id');
        
        if(!$initiativeID->isEmpty()) {
            $articles = Article::where('initiative_id', '=', $initiativeID[0]->id)->get();

            return view('articles', ['articles' => $articles]);
        }

        return response(404);
    }
}
