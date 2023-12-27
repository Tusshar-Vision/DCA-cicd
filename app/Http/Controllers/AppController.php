<?php

namespace App\Http\Controllers;

use App\Models\InitiativeTopic;
use App\Models\Paper;
use App\Models\TopicSection;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function getPapers()
    {
        $papers = Paper::all();
        return response()->json($papers);
    }

    public function getSubjectsOfPaper($paper_id)
    {
        $subjects = InitiativeTopic::where('paper_id', $paper_id)->get();
        return response()->json($subjects);
    }

    public function getSectionsOfSubject($subject_id)
    {
        $sections = TopicSection::where('topic_id', $subject_id)->get();
        return response()->json($sections);
    }
}
