<?php

namespace App\Http\Controllers;


class NavigationController extends Controller
{
    public function renderHomePage() {
        return View('home');
    }

    public function renderNewsTodayPage() {
        return View('news-today');
    }

    public function renderMonthlyMagazinePage() {
        return View('monthly-magazine');
    }

    public function renderWeeklyFocusPage() {
        return View('weekly-focus');
    }

    public function renderMains365Page() {
        return View('mains-365');
    }

    public function renderPT365Page() {
        return View('pt-365');
    }

    public function renderDownloadsPage() {
        return View('downloads');
    }

    public function renderMonthlyMagazineArchivesPage() {
        return View('archives.monthly-magazine');
    }

    public function renderWeeklyFocusArchivesPage() {
        return View('archives.weekly-focus');
    }

    public function renderDailyNewsArchivesPage() {
        return View('archives.daily-news');
    }
}
