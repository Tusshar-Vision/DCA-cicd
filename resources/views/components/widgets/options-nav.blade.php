<div class="flex h-14 items-center justify-between text-base">
    <div class="-ml-4 text-visionLineGray">
        {{--        {{ Breadcrumbs::render('home') }} --}}
    </div>

    <div class="flex flex-row">
        @auth('cognito')
            <div class="flex mr-6">
                <button class="flex items-center">
                    <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 0H15C15.5523 0 16 0.44772 16 1V20.1433C16 20.4194 15.7761 20.6434 15.5 20.6434C15.4061 20.6434 15.314 20.6168 15.2344 20.5669L8 16.0313L0.76559 20.5669C0.53163 20.7136 0.22306 20.6429 0.0763698 20.4089C0.0264698 20.3293 0 20.2373 0 20.1433V1C0 0.44772 0.44772 0 1 0ZM14 2H2V17.4324L8 13.6707L14 17.4324V2Z"
                            fill="#8F93A3" />
                    </svg>
                    <span class="pl-2 text-visionLineGray">Bookmark</span>
                </button>
            </div>
            <div class="flex mr-6">
                <button class="flex items-center">
                    <svg width="19" height="21" viewBox="0 0 19 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 20V18H2V2H12V6H16V13H17.9998V5L13 0H0.9985C0.44749 0 0 0.44405 0 0.9918V19.0082C0 19.5447 0.44476 20 0.9934 20H9Z"
                            fill="#8F93A3" />
                        <path
                            d="M10.4645 17.2929L14 20.8284L18.9497 15.8787L17.5355 14.4644L14 18L11.8787 15.8787L10.4645 17.2929Z"
                            fill="#8F93A3" />
                        <path d="M8 4H5V6H8V4Z" fill="#8F93A3" />
                        <path d="M13 8V10H5V8H13Z" fill="#8F93A3" />
                        <path d="M13 12V14H5V12H13Z" fill="#8F93A3" />
                    </svg>
                    <span class="pl-2 text-visionLineGray">Mark as Read</span>
                </button>
            </div>
        @endauth
        <div x-data="{ isFullScreen: false }" class="flex">
            <button class="flex items-center" @click="toggleFullScreen()">
                <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 0V2H2V6H0V0H6ZM0 18V12H2V16H6V18H0ZM20 18H14V16H18V12H20V18ZM20 6H18V2H14V0H20V6Z"
                        fill="#8F93A3" />
                </svg>
                <span class="pl-2 text-visionLineGray">Fullscreen</span>
            </button>
        </div>
    </div>
    <script>
        function toggleFullScreen() {
            const isFullScreen = document.fullscreenElement !== null;

            if (isFullScreen) {
                document.exitFullscreen(); // Exit fullscreen mode
            } else {
                document.documentElement.requestFullscreen(); // Enter fullscreen mode
            }
        }
    </script>
</div>
