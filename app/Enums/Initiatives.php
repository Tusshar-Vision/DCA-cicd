<?php

namespace App\Enums;
enum Initiatives : string {
    case NEWS_TODAY = 'News Today';
    case MONTHLY_MAGAZINE = 'Monthly Magazine';
    case WEEKLY_FOCUS = 'Weekly Focus';
    case MAINS_365 = 'Mains 365';
    case PT_365 = 'PT 365';
    case DOWNLOADS = 'Downloads';
    case MORE = 'More';
}
