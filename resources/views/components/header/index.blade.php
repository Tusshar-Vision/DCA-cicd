<header class="h-auto lg:h-20 py-[20px] lg:py-0 border-b border-visionLineGray md:flex md:w-full md:align-middle">
    <div class="flex items-center justify-between md:w-full">
        <div class="hidden lg:block">
            <a href="/" wire:navigate>
                <img width="200px" src="{{ asset('images/LightLogo.svg') }}" alt="VisionIAS Logo" />
            </a>
        </div>

        <div class="w-full flex lg:space-x-5 items-center lg:justify-end justify-between space-x-0">
            <!-- <button class="flex" onclick="switchLang()">
                <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 11.0196L2.98039 7.45923M8.86273 11.0196L7.93394 7.45923M2.98039 7.45923L4.48366 2H6.5098L7.93394 7.45923M2.98039 7.45923H7.93394" stroke="#8F93A3" stroke-width="2"/>
                    <path d="M12.2617 14.2875C15.8565 10.6273 19.2226 17 14.2226 17.5556M14.2226 17.5556C19.2226 18.6667 15.3993 24.5979 12.2617 20.5127M14.2226 17.5556L19.8434 17.4902M19.8434 17.4902V13.307H22.0003M19.8434 17.4902V22.0002" stroke="#8F93A3" stroke-width="2"/>
                    <path d="M12.9805 5.26776C16.1177 5.26776 16.706 5.5292 16.706 8.66645" stroke="#8F93A3" stroke-width="2"/>
                    <path d="M8.79785 17.49C5.6606 17.49 5.07237 17.2285 5.07237 14.0913" stroke="#8F93A3" stroke-width="2"/>
                </svg>
                <span id="lang">{{__('header.lang')}}</span>
            </button>


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

            <!-- @guest
                <button @click="isLoginFormOpen = !isLoginFormOpen"  class="flex items-center">
                    <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" fill="#040404"/>
                    </svg>
                    {{__('header.login')}}
                </button>
            @endguest

            @auth
                <div class="flex items-center font-bold cursor-pointer" x-data="{ isUserMenuOpen: false }" @click="isUserMenuOpen = true">
                    <svg class="mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" fill="#040404"/>
                    </svg>
                    {{ Auth::user()->name ?? 'No Name' }}

                    <x-auth.user-dropdown-menu x-show="isUserMenuOpen" />
                </div>
            @endauth -->
            <div class="flex order-last lg:order-first">
                <ul class="flex items-center">
                    <li class="ml-[10px] md:ml-[15px]"><a href="https://whatsapp.com/channel/0029Va6Adw242DcXgbUgQz1m" target="_blank"><img src="{{ asset('images/whtsapp.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px]"><a href="https://www.facebook.com/pages/Vision-IAS/233212040049021" target="_blank"><img src="{{ asset('images/fb.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px]"><a href="https://www.youtube.com/channel/UCw4wosjC-DKq95xI5klz92w" target="_blank"><img src="{{ asset('images/youtube.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px] hidden lg:flex"><a href="https://twitter.com/vision_IAS" target="_blank"><img src="{{ asset('images/twitter.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px] hidden lg:flex"><a href="https://www.instagram.com/vision_ias/" target="_blank"><img src="{{ asset('images/insta.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px] hidden lg:flex"><a href="https://t.me/VisionIAS_UPSC" target="_blank"><img src="{{ asset('images/telegram.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                </ul>
                <ul class="items-center" style="display: none" id="socialList">
                    <li class="ml-[10px] md:ml-[15px]"><a href="https://twitter.com/vision_IAS" target="_blank"><img src="{{ asset('images/twitter.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px]"><a href="https://www.instagram.com/vision_ias/" target="_blank"><img src="{{ asset('images/insta.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                    <li class="ml-[10px] md:ml-[15px]"><a href="https://t.me/VisionIAS_UPSC" target="_blank"><img src="{{ asset('images/telegram.svg') }}" class="w-[20px] md:w-[26px]"></a></li>
                </ul>
                <a href="javascript:void(0)" class="block lg:hidden pl-[15px] mx-[15px] border-slate-300 border-solid border-l-[1px]"><img src="{{ asset('images/mode.svg') }}"></a>
                <a href="javascript:void(0)" class="block lg:hidden text-[50px] leading-5" id="toggleSocialbtn" onclick="toggleSocial()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 14 14" fill="none">
                        <path d="M0 2C0 0.89543 0.895431 0 2 0H12C13.1046 0 14 0.895431 14 2V12C14 13.1046 13.1046 14 12 14H2C0.89543 14 0 13.1046 0 12V2Z" fill="#E5EAF4"/>
                        <path d="M5.84753 4.65633C5.77826 4.65481 5.71024 4.67489 5.65292 4.71381C5.5956 4.75273 5.55183 4.80857 5.5277 4.87352C5.50357 4.93847 5.50028 5.00931 5.51828 5.07621C5.53627 5.14312 5.57467 5.20273 5.62813 5.2468L7.66784 6.9942L5.62813 8.74098C5.59115 8.76815 5.56018 8.80266 5.53716 8.84236C5.51414 8.88206 5.49956 8.9261 5.49435 8.9717C5.48913 9.01729 5.49339 9.06347 5.50684 9.10734C5.5203 9.15122 5.54267 9.19185 5.57256 9.22668C5.60244 9.26151 5.6392 9.28976 5.68052 9.30973C5.72184 9.32969 5.76684 9.34091 5.8127 9.34268C5.85856 9.34445 5.90429 9.33675 5.94703 9.32003C5.98977 9.30331 6.02859 9.27794 6.06107 9.24552L8.39636 7.24745C8.43303 7.21615 8.46248 7.17731 8.48267 7.13353C8.50286 7.08975 8.51332 7.0421 8.51332 6.99389C8.51332 6.94568 8.50286 6.89803 8.48267 6.85425C8.46248 6.81047 8.43303 6.77159 8.39636 6.74029L6.06107 4.7403C6.00208 4.6879 5.92641 4.65811 5.84753 4.65625V4.65633Z" fill="#242424"/>
                    </svg>
                </a>
            </div>
            <div class="order-first lg:order-last">
                <ul class="flex items-center w-full connect-us">
                    <li class="pl-[20px] lg:pr-[20px] hidden lg:block"><a href="javascript:void(0)"><img src="{{ asset('images/mode.svg') }}"></a></li>
                    <li class="lg:pl-[20px] lg:pr-[20px] pr-[5px] flex items-center pl-0">
                        <a href="tel:+91 846 802 2022" class="md:block lg:hidden"><img src="{{ asset('images/call.svg') }}" width="15"></a>
                        <img src="{{ asset('images/call.svg') }}" class="hidden lg:block">
                        <div class="ml-[8px] hidden lg:block">
                            <span>Call Us</span>
                            <p class="text-xs">
                                <a href="tel:+91 846 802 2022" class="hover:text-[#005FAF] hidden lg:block">+91 846 802 2022,</a> 
                                <a href="tel:+91 901 906 6066" class="hover:text-[#005FAF] hidden lg:block">+91 901 906 6066</a></p>
                        </div>
                    </li>
                    <li class="lg:pl-[20px] pl-[5px] flex items-center">
                        <a href="mailto:enquiry@visionias.in" class="md:block lg:hidden"><img src="{{ asset('images/mail.svg') }}" width="15"></a>
                        <img src="{{ asset('images/mail.svg') }}" class="hidden lg:block">
                        <div class="ml-[8px] hidden lg:block">
                            <span>Email Us</span>
                            <p class="text-xs"><a href="mailto:enquiry@visionias.in" class="hover:text-[#005FAF]">Enquiry@visionias.in</a></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">  

    function toggleSocial() {
        var list = document.getElementById("socialList");
        var button = document.getElementById("toggleSocialbtn");

        // Toggle the visibility of the list
        if (list.style.display === "none") {
        list.style.display = "flex";
        button.style.transform = 'rotate(0deg)';
        } else {
        list.style.display = "none";
        button.style.transform = 'rotate(180deg)';
        }
    }

    var url = "{{ route('lang.change') }}";

    function switchLang() {
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
        };
        
    } 

    

    // document.addEventListener('DOMContentLoaded', function() {
    //     const toggleButton = document.getElementById('toggleSocial');
    //     const myList = document.getElementById('socialList');
    //     const listItems = myList.getElementsByTagName('li');
    //     const lastThreeItems = Array.prototype.slice.call(listItems, -3);
    //     toggleButton.addEventListener('click', function() {
    //         lastThreeItems.forEach(function(item) {
    //         item.style.display = (item.style.display === 'none' || item.style.display === '') ? 'list-item' : 'none';
    //         });
    //     });
    // });

</script>
