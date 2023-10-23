<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show($initiative, $topic, $article_id, $article_slug) {

        dump([$initiative, $topic, $article_id, $article_slug]);
    }
}
