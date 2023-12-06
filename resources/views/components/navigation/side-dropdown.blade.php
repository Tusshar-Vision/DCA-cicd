@php
    use App\Helpers\InitiativesHelper;
    use Illuminate\Support\Carbon;
@endphp

<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bg-visionGray shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        @foreach ($getDataToRender as $key => $value)
            <li>
                <a href="{{ ($initiativeId == InitiativesHelper::getInitiativeID('WEEKLY_FOCUS'))
                                ? route('weekly-focus.article', ['date'=> Carbon::parse($value['date'])->format('Y-m-d'),'topic' => $value['topic'], 'article_slug' => $value['slug']])
                                : ($initiativeId == InitiativesHelper::getInitiativeID('MONTHLY_MAGAZINE')
                                ? route('monthly-magazine-of-month.article', ['month' => $menuData[1][$key]['year']])
                                : '#')
                         }}"
                   class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray"
                >
                    <span class="ml-2 font-medium">{{ $initiativeId == InitiativesHelper::getInitiativeID('WEEKLY_FOCUS') ? $value['title'] : $value }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
