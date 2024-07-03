<?php

namespace App\Livewire\Widgets;

use App\Services\UserService;
use Livewire\Component;

class Leaderboard extends Component
{
    public $scoreBoard;

    public function mount($scoreBoard): void
    {
        $this->scoreBoard = $scoreBoard;
    }
    public function getData(UserService $userService): void
    {
        $this->scoreBoard = $userService->getScoreBoard();
    }
    public function render()
    {
        return view('livewire.widgets.leaderboard');
    }
}
