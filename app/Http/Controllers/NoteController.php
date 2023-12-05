<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    public function index()
    {
        return Note::all();
    }

    public function addNote(Request $request)
    {
        $params = $request->all();

        logger("params", [$params]);

        $note = Note::create([
            'user_id' => $params['user_id'],
            'article_id' => $params['article_id'],
            'title' => $params['note_title'],
            'content' => $params['note'],
            'topic_id' => $params['topic_id'],
            'topic_section_id' => $params['topic_section_id'],
            'topic_sub_section_id' => $params['topic_sub_section_id'],
        ]);

        return response()->json(['data' => $note], 200);
    }
}
