<?php

namespace App\Livewire\Widgets;

use Livewire\Component;

class StudentMycontentSection extends Component
{
    public $type;
    public $papers;
    public $paper;
    public $topics;
    public $topic;
    public $sections;
    public $section;
    public $articles;

    public function mount($type, $papers, $paper, $topics, $topic, $sections, $section, $articles)
    {
        $this->type = $type;
        $this->papers = $papers;
        $this->paper = $paper;
        $this->topics = $topics;
        $this->topic = $topic;
        $this->sections = $sections;
        $this->section = $section;
        $this->articles = $articles;
    }

    public function render()
    {
        return view('livewire.widgets.student-mycontent-section');
    }
}
