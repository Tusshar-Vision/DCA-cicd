<div {{ $attributes }} x-cloak>
    <ul class="absolute font-normal bgcolor-FFF shadow w-80 border rounded-md my-2 py-6 z-50 dark:bg-dark373839">
        @foreach ($menuData['data'] as $route => $heading)
            @if($route != '/weekly-round-table' && $route != '/animated-shorts' && $route != '/pyq' && $route != '/value-added-material' && $route != '/value-added-material-optional')
                <li class="relative">
                    <a href="{{ $route }}"
                       wire:navigate
                       class="flex items-center justify-between mx-2 py-2 hover:brand-color hover:bgcolor-gray-F4F6FC dark:hover:bg-transparent firstlabelMenu"
                    >
                        <span class="px-4 font-medium text-sm">
                            {{ $heading }}
                        </span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
