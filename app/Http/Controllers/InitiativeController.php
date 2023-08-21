<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Initiative;
use App\Models\PublishedInitiative;
use Illuminate\Http\Request;

class InitiativeController extends Controller
{
    public function index() {
        $initiatives = Initiative::get(['name', 'description', 'path']);    
        return view('index')->with('initiatives', $initiatives);
    }

    public function getArticles($initiative) {

        $initiatives = Initiative::get(['name', 'description', 'path']);   
        $initiativePath = '/' . $initiative;
        $initiativeID = Initiative::where('path', '=', $initiativePath)->get('id');
        
        if($initiativeID->isNotEmpty()) {
            $articles = Article::where('initiative_id', '=', $initiativeID[0]->id)->get();

            return view('articles', ['articles' => $articles, 'initiatives' => $initiatives]);
        }

        return response(404);
    }

    public function getPublishedInitiatives($initiative) {
        $initiatives = Initiative::get(['name', 'description', 'path']);   
        $initiativePath = '/' . $initiative;
        $initiativeID = Initiative::where('path', '=', $initiativePath)->get('id');

        if($initiativeID->isNotEmpty()) {
            $published_initiatives = Initiative::findOrFail($initiativeID[0]->id)->publishedVersions;
            // return view('articles', ['articles' => $articles, 'initiatives' => $initiatives]);
        }
    }
}
