@php
    $mediaFile = $media?->first();
@endphp

@if ($initiative === 'monthly-magazine')
    <div class="flex flex-col rounded bg-visionGray mb-4" @click="printDiv">
        <div class="my-8 mx-6">
            <div class="flex items-center justify-between cursor-pointer">
                <div class="flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect x="2" y="2" width="20" height="20" rx="4" fill="#FD2B44"/>
                        <path d="M10.7078 8.82981C10.0408 8.44718 9.5 8.76064 9.5 9.52936V15.2022C9.5 15.9717 10.0408 16.2848 10.7078 15.9025L15.6662 13.0589C16.3335 12.6762 16.3335 12.056 15.6662 11.6734L10.7078 8.82981Z" fill="white"/>
                    </svg>
                    <span>
                        Download Current Article
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="flex flex-col rounded bg-visionGray lg:mt-0 mt-8 {{ $mediaFile === null ? 'opacity-50 pointer-events-none' : '' }}">
    <a href="{{ $mediaFile ? route('download', ['media' => $mediaFile]): "#"}}" target="_blank">
        <div class="my-8 mx-6">
            <div class="flex items-center justify-between">
                <div class="flex space-x-2">
                    <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.9985 0C0.44749 0 0 0.44405 0 0.9918V19.0082C0 19.5447 0.44476 20 0.9934 20H17.0066C17.5551 20 18 19.5489 18 18.9925L17.9997 5L13 0H0.9985ZM7.5 5.5H9.5C9.5 7.98994 11.6436 10.6604 14.3162 11.5513L13.8586 13.49C10.7234 13.0421 7.4821 14.3804 4.5547 16.3321L3.3753 14.7191C4.46149 13.8502 5.50293 12.3757 6.27499 10.6534C7.0443 8.9373 7.5 7.07749 7.5 5.5ZM8.1 11.4716C8.3673 10.8752 8.6043 10.2563 8.8037 9.6285C9.2754 10.3531 9.8553 11.0182 10.5102 11.5953C9.5284 11.7711 8.5666 12.0596 7.6353 12.4276C7.8 12.1143 7.9551 11.7948 8.1 11.4716Z" fill="#FD2B44"/>
                    </svg>
                    <span>
                        @if ($initiative === 'news-today')
                            Download News Today
                        @elseif($initiative === 'weekly-focus')
                            Download Weekly Focus
                        @else
                            Download Magazine
                        @endif
                    </span>
                </div>
                <div>
                    <svg width="24" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 20H1C0.44772 20 0 19.5523 0 19V1C0 0.44772 0.44772 0 1 0H17C17.5523 0 18 0.44772 18 1V19C18 19.5523 17.5523 20 17 20ZM16 18V2H2V18H16ZM4 4H8V8H4V4ZM4 10H14V12H4V10ZM4 14H14V16H4V14ZM10 5H14V7H10V5Z" fill="#8F93A3"/>
                    </svg>
                </div>
            </div>
        </div>
    </a>
</div>

<script>
    function printDiv() {
        var printContents = document.getElementsByClassName('printable-area')[0]?.innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
