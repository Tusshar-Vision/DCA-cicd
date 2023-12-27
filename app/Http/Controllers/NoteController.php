<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if ($tags = Arr::get($params, 'tags')) {
            logger("tags", [$tags]);
            foreach ($tags as $tag) $note->attachTag($tag);
        }

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

    public function addTag($note_id)
    {
        $inputs = request()->all();

        $tag = $inputs['tag'];
        $note = Note::find($note_id);
        $isAlreadPresentTag =  $note->tags->where('name', $tag)->count();
        if ($isAlreadPresentTag > 0) {
            return response()->json(['status' => 200]);
        } else {
            $note->attachTag($tag);
            return response()->json(['data' => $tag, 'status' => 201]);
        }
    }

    public function searchTagsLike($search)
    {
        $tags = Tag::where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%')->get();
        $data = [];
        foreach ($tags as $tag) {
            $name = json_decode($tag->name);
            $data[] = $name->en;
        }
        return response()->json(['data' => $data, 'status' => 200]);
    }

    public function getFilteredNotes()
    {
        $topic_id = request()->input('topic_id');
        $section_id = request()->input('section_id');
        $notes = Note::where('user_id', Auth::guard('cognito')->user()->id)->where('topic_id', $topic_id)->where('topic_section_id', $section_id)->get();
        return response()->json($notes);
    }
}
