@php
    use App\Helpers\InitiativesHelper;
    use Illuminate\Support\Carbon;
    use App\Enums\Initiatives;
@endphp

<div {{ $attributes }} x-cloak>
    <ul class="absolute ml-2 font-normal bgcolor-FFF shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        @foreach ($getDataToRender as $key => $data)
            <li>
                <a href="{{ ( $initiativeId === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS) ) ?
                                route(
                                    'weekly-focus.article',
                                    [
                                        'date' => $data['date'],
                                        'topic' => strtolower($data['topic']),
                                        'article_slug' => $data['slug']
                                    ]
                                ) : ( $initiativeId === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE) ?
                                route(
                                    'monthly-magazine.article',
                                    [
                                        'date' => $data['date'],
                                        'topic' => strtolower($data['topic']),
                                        'article_slug' => $data['slug']
                                    ]
                                ) : '')
                         }}"
                   class="flex items-center justify-between px-3 py-2 hover:brand-color hover:bgcolor-gray-F4F6FC"
                >
                    <span class="ml-2 font-medium text-sm">
                        {{ $data['title'] }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
