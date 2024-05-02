@php
    use App\Helpers\InitiativesHelper;
    use App\Enums\Initiatives;
    $pdf = $file->media->first();
@endphp
<div class="vi-pdf-card">
    <div class="vi-card-header">
        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.9985 0C0.44749 0 0 0.44405 0 0.9918V19.0082C0 19.5447 0.44476 20 0.9934 20H17.0066C17.5551 20 18 19.5489 18 18.9925L17.9997 5L13 0H0.9985ZM7.5 5.5H9.5C9.5 7.98994 11.6436 10.6604 14.3162 11.5513L13.8586 13.49C10.7234 13.0421 7.4821 14.3804 4.5547 16.3321L3.3753 14.7191C4.46149 13.8502 5.50293 12.3757 6.27499 10.6534C7.0443 8.9373 7.5 7.07749 7.5 5.5ZM8.1 11.4716C8.3673 10.8752 8.6043 10.2563 8.8037 9.6285C9.2754 10.3531 9.8553 11.0182 10.5102 11.5953C9.5284 11.7711 8.5666 12.0596 7.6353 12.4276C7.8 12.1143 7.9551 11.7948 8.1 11.4716Z" fill="#FD2B44"/>
        </svg>
        <a href="{{ route($pdf->collection_name) }}" class="vi-category" wire:navigate>{{ ucfirst($pdf->collection_name) }}</a>
    </div>
    <p class="vi-card-body-text">
        <span class="font-bold"></span> {{ $file->name ?? $pdf->name}}
    </p>
    <div class="vi-card-footer">
        <a href="{{ route('download', ['media' => $pdf]) }}" class="flex items-center vi-downloads-links downloads" target="_blank">
            <span>Download</span>
        </a>
        <span class="vi-divider"></span>
        @if(
            $file->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY) ||
            $file->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS) ||
            $file->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)
            )
            <a wire:navigate href="{{ \App\Services\ArticleService::getArticleUrlFromSlug( $file->articles()->first()->slug ) }}" class="flex items-center vi-downloads-links source-file">
                <span>Read</span>
            </a>
        @else
            <a wire:navigate href="{{ route($pdf->collection_name) . '/' . $pdf->id }}" class="flex items-center vi-downloads-links source-file">
                <span>Read</span>
            </a>
        @endif
    </div>
</div>
