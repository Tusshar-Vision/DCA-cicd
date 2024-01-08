@php
    use App\Helpers\InitiativesHelper;
    use Illuminate\Support\Carbon;
    use App\Enums\Initiatives;
@endphp

<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bgcolor-FFF shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        @foreach ($getDataToRender as $key => $value)
            <li>
                <a href="{{ ( $initiativeId === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS) ) ?
                                route(
                                    'weekly-focus.article',
                                    [
                                        'date' => Carbon::parse($value['date'])->format('Y-m-d'),
                                        'topic' => strtolower($value['topic']),
                                        'article_slug' => $value['slug']
                                    ]
                                ) : ( $initiativeId === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE) ?
                                route(
                                    'monthly-magazine.article',
                                    [
                                        'date' => $value['date'],
                                        'topic' => strtolower($value['topic']),
                                        'article_slug' => $value['slug']
                                    ]
                                ) : '')
                         }}"
                   class="flex items-center justify-between px-3 py-2 hover:brand-color hover:bgcolor-gray-F4F6FC"
                >
                    <span class="ml-2 font-medium text-sm">
                        {{ $value['title'] }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
