<div>
    <img src="{{ $infographic?->media?->first()?->getTemporaryUrl(now()->add('minutes', 120)) }}"  alt="infographic"/>
</div>
