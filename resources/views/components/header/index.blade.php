@php
    use App\Helpers\SvgIconsHelper;
    use App\Helpers\UrlHelper;
@endphp

<header class="h-auto lg:h-20 py-[20px] lg:py-0 border-b border-visionLineGray md:flex md:w-full md:align-middle">
    <div class="flex items-center justify-between md:w-full">
        <div class="hidden xl:block">
            <a href="{{ route('home') }}">
                <img class="w-60 dark:hidden" src="{{ asset('images/LightLogo.svg') }}" alt="VisionIAS Logo" />
                <img class="w-60 hidden dark:block" src="{{ asset('images/DarkLogo.svg') }}" alt="Dark VisionIAS Logo" />
            </a>
        </div>
        <a href="https://visionias.in/" class="group flex items-center text-nowrap ml-0 xl:ml-6 mr-2 xl:mr-0 text-[#242424] font-medium text-[14px] dark:text-[#8F93A3]">
            <span class="text-[18px] mr-1">
                <svg width="7" height="9" viewBox="0 0 7 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="group-hover:stroke-[#005FAF] dark:stroke-white" d="M0.597656 4.03516L4.31641 0.316406C4.58984 0.0429688 5 0.0429688 5.24609 0.316406L5.875 0.917969C6.12109 1.19141 6.12109 1.60156 5.875 1.84766L3.22266 4.47266L5.875 7.125C6.12109 7.37109 6.12109 7.78125 5.875 8.05469L5.24609 8.65625C5 8.92969 4.58984 8.92969 4.31641 8.65625L0.597656 4.9375C0.351562 4.69141 0.351562 4.28125 0.597656 4.03516Z" fill="#242424"/>
                </svg>
            </span>
            <span class="hidden md:inline-block group-hover:text-[#005FAF]">Back to VisionIAS</span>
        </a>
        <div class="w-full flex xl:space-x-5 items-center xl:justify-end justify-between space-x-0">
            <div class="flex order-last xl:order-first topMenu">
                <ul class="flex items-center">
                    <li class="ml-[10px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('whatsapp') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('whatsapp-header') !!}
                        </a>
                    </li>
                    <li class="ml-[10px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('facebook') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('facebook-header') !!}
                        </a>
                    </li>
                    <li class="ml-[10px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('youtube') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('youtube-header') !!}
                        </a>
                    </li>
                    <li class="ml-[8px] md:ml-[15px] hidden xl:flex">
                        <a href="{{ UrlHelper::linkToSocial('twitter') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('twitter-header') !!}
                        </a>
                    </li>
                    <li class="ml-[8px] md:ml-[15px] hidden xl:flex">
                        <a href="{{ UrlHelper::linkToSocial('instagram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('instagram-header') !!}
                        </a>
                    </li>
                    <li class="ml-[8px] md:ml-[15px] hidden xl:flex">
                        <a href="{{ UrlHelper::linkToSocial('telegram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('telegram-header') !!}
                        </a>
                    </li>
                </ul>
                <ul class="items-center" style="display: none" id="socialList">
                    <li class="ml-[8px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('twitter') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('twitter-header') !!}
                        </a>
                    </li>
                    <li class="ml-[8px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('instagram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('instagram-header-mobile') !!}
                        </a>
                    </li>
                    <li class="ml-[8px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('telegram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('telegram-header') !!}
                        </a>
                    </li>
                </ul>
                <a href="javascript:void(0)" class="block xl:hidden text-[50px] leading-5 h-[23px] ml-2" id="toggleSocialbtn" onclick="toggleSocial()">
                    {!! SvgIconsHelper::getSvgIcon('right-arrow') !!}
                </a>
            </div>
            <div class="order-first xl:order-last">
                <ul class="flex items-center w-full connect-us">
                    <li class="xl:pl-[20px] xl:pr-[20px] pr-[5px] flex items-center pl-0">
                        <a href="tel:+91 846 802 2022">
                            {!! SvgIconsHelper::getSvgIcon('call-icon') !!}
                        </a>

                        <div class="ml-[8px] hidden xl:block">
                            <span>Call Us</span>
                            <p class="text-xs">
                                <a href="tel:+91 846 802 2022" class="hover:text-[#005FAF] hidden lg:inline-block">+91 846 802 2022,</a>
                                <a href="tel:+91 901 906 6066" class="hover:text-[#005FAF] hidden lg:inline-block">+91 901 906 6066</a>
                            </p>
                        </div>
                    </li>
                    <li class="xl:pl-[20px] pl-[5px] flex items-center">
                        <a href="mailto:enquiry@visionias.in" class="dark:fill-white">
                            {!! SvgIconsHelper::getSvgIcon('mail-icon') !!}
                        </a>

                        <div class="ml-[8px] hidden xl:block">
                            <span>Email Us</span>
                            <p class="text-xs"><a href="mailto:enquiry@visionias.in" class="hover:text-[#005FAF]">enquiry@visionias.in</a></p>
                        </div>
                    </li>
                    <li class="block pl-[15px] mx-0 xl:mx-[15px] modeSvg">
                        <a href="javascript:void(0)"
                            @click="isDarkModeEnabled = !isDarkModeEnabled;
                            localStorage.setItem('isDarkModeEnabled', isDarkModeEnabled);">
                            <div x-show="!isDarkModeEnabled">
                                {!! SvgIconsHelper::getSvgIcon('dark-mode-toggle') !!}
                            </div>

                            <div x-show="isDarkModeEnabled">
                                {!! SvgIconsHelper::getSvgIcon('light-mode-toggle') !!}
                            </div>
                        </a>
                    </li>
{{--                    <li class="block pl-[15px] modeSvg">--}}
{{--                        <button class="flex" onclick="switchLang()">--}}
{{--                            {!! SvgIconsHelper::getSvgIcon('lang-icon') !!}--}}
{{--                            <span id="lang">{{__('header.lang')}}</span>--}}
{{--                        </button>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">

    function toggleSocial() {
        const list = document.getElementById("socialList");
        const button = document.getElementById("toggleSocialbtn");
        // Toggle the visibility of the list
        if (list.style.display === "none") {
        list.style.display = "flex";
        button.style.transform = 'rotate(0deg)';
        } else {
        list.style.display = "none";
        button.style.transform = 'rotate(180deg)';
        }
    }

    function switchLang() {
        const url = "{{ route('lang.change') }}";
        let ele = document.getElementById("lang");
        let toConvertLang, msg;

        if(ele.innerText.toLowerCase() === "english") {
            msg = "क्या आप वेबसाइट की भाषा को हिंदी में बदलना चाहते हैं ?";
            toConvertLang = "hi";
        } else {
            toConvertLang = "en";
            msg = "Do you want to change the website language to English ?";
        }

        if(confirm(msg)) {
           window.location.href = url + "?lang="+ toConvertLang;
        }
    }
</script>
