@php
    use App\Helpers\SvgIconsHelper;
    use App\Helpers\UrlHelper;
@endphp

<header class="h-auto lg:h-20 py-[20px] lg:py-0 border-b border-visionLineGray md:flex md:w-full md:align-middle">
    <div class="flex items-center justify-between md:w-full">
        <div class="hidden xl:block">
            <a href="{{ route('home') }}" wire:navigate>
                <img class="w-60" src="{{ asset('images/LightLogo.svg') }}" alt="VisionIAS Logo" />
            </a>
        </div>

        <div class="w-full flex xl:space-x-5 items-center xl:justify-end justify-between space-x-0">
            <!--
            <svg width="2" height="32" viewBox="0 0 2 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" d="M1 0V32" stroke="#8F93A3"/>
            </svg>

            <div class="flex items-center space-x-2">
                <button @click="document.body.style.fontSize = `${(isNaN(parseFloat(document.body.style.fontSize)) ? 1.1 : parseFloat(document.body.style.fontSize) + 0.1)}rem`">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="22" height="22" stroke="#8F93A3" stroke-width="2"/>
                        <path d="M6.97869 17H5.34801L9.01207 6.81818H10.7869L14.451 17H12.8203L9.94176 8.66761H9.86222L6.97869 17ZM7.25213 13.0128H12.5419V14.3054H7.25213V13.0128ZM15.428 11.4964V7.19602H16.467V11.4964H15.428ZM13.6879 9.85582V8.83665H18.1822V9.85582H13.6879Z" fill="#8F93A3"/>
                    </svg>
                </button>

                <button @click="document.body.style.fontSize = `${(isNaN(parseFloat(document.body.style.fontSize)) ? 0.9 : parseFloat(document.body.style.fontSize) - 0.1)}rem`">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="22" height="22" stroke="#8F93A3" stroke-width="2"/>
                        <path d="M6.97869 17H5.34801L9.01207 6.81818H10.7869L14.451 17H12.8203L9.94176 8.66761H9.86222L6.97869 17ZM7.25213 13.0128H12.5419V14.3054H7.25213V13.0128ZM18.1822 8.83665V9.85582H13.6879V8.83665H18.1822Z" fill="#8F93A3"/>
                    </svg>
                </button>
            </div>

            <svg width="2" height="32" viewBox="0 0 2 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" d="M1 0V32" stroke="#8F93A3"/>
            </svg> -->
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
                    <li class="ml-[10px] md:ml-[15px] hidden xl:flex">
                        <a href="{{ UrlHelper::linkToSocial('twitter') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('twitter-header') !!}
                        </a>
                    </li>
                    <li class="ml-[10px] md:ml-[15px] hidden xl:flex">
                        <a href="{{ UrlHelper::linkToSocial('instagram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('instagram-header') !!}
                        </a>
                    </li>
                    <li class="ml-[10px] md:ml-[15px] hidden xl:flex">
                        <a href="{{ UrlHelper::linkToSocial('telegram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('telegram-header') !!}
                        </a>
                    </li>
                </ul>
                <ul class="items-center" style="display: none" id="socialList">
                    <li class="ml-[10px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('twitter') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('twitter-header') !!}
                        </a>
                    </li>
                    <li class="ml-[10px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('instagram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('instagram-header-mobile') !!}
                        </a>
                    </li>
                    <li class="ml-[10px] md:ml-[15px]">
                        <a href="{{ UrlHelper::linkToSocial('telegram') }}" target="_blank">
                            {!! SvgIconsHelper::getSvgIcon('telegram-header') !!}
                        </a>
                    </li>
                </ul>
{{--                <a href="javascript:void(0)" class="block xl:hidden pl-[15px] mx-[15px] border-slate-300 border-solid border-l-[1px] modeSvg">--}}
{{--                    {!! SvgIconsHelper::getSvgIcon('dark-mode-toggle') !!}--}}
{{--                </a>--}}
                <a href="javascript:void(0)" class="block xl:hidden text-[50px] leading-5 h-[23px] ml-4" id="toggleSocialbtn" onclick="toggleSocial()">
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
                        <a href="mailto:enquiry@visionias.in">
                            {!! SvgIconsHelper::getSvgIcon('mail-icon') !!}
                        </a>

                        <div class="ml-[8px] hidden xl:block">
                            <span>Email Us</span>
                            <p class="text-xs"><a href="mailto:enquiry@visionias.in" class="hover:text-[#005FAF]">enquiry@visionias.in</a></p>
                        </div>
                    </li>
                    <li class="block pl-[15px] mx-[15px] border-slate-300 border-solid border-l-[1px] modeSvg">
                        {{-- xl:block --}}
                        <a href="javascript:void(0)">
                            {!! SvgIconsHelper::getSvgIcon('dark-mode-toggle') !!}
                        </a>
                    </li>
                    <li class="block pl-[15px] border-slate-300 border-solid border-l-[1px] modeSvg">
                        <button class="flex" onclick="switchLang()">
                            {!! SvgIconsHelper::getSvgIcon('lang-icon') !!}
{{--                            <span id="lang">{{__('header.lang')}}</span>--}}
                        </button>
                    </li>
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
