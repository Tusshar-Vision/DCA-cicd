<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return $notes;
    }

    public function addNote(Request $request)
    {
        $params = $request->all();

        $userId = $params['user_id'];
        $articleId = $params['article_id'];
        $title = $params['note_title'];
        $content = $params['note'];
        $topicId = $params['topic_id'];
        $topicSectionId = $params['topic_section_id'];
        $topicSubSectionId = $params['topic_sub_section_id'];

        $note = Note::where('user_id', $userId)
            ->where('article_id', $articleId)
            ->first();

        if ($note) {
            $note->title = $title;
            $note->content = $content;
            $note->save();
        } else {
            $note = Note::create([
                'user_id' => $userId,
                'article_id' => $articleId,
                'title' => $title,
                'content' => $content,
                'topic_id' => $topicId,
                'topic_section_id' => $topicSectionId,
                'topic_sub_section_id' => $topicSubSectionId,
            ]);
        }

        // $note->noteContents()->create(['content' => $content]);

        return response()->json(['data' => $note], 200);
    }

    public function getNotesByArticleId($article_id)
    {
        $notes = Note::where('user_id', Auth::user()->id)
            ->where('article_id', $article_id)
            // ->with('noteContents')
            ->first();

        return $notes;
    }
}
