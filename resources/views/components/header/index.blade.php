<header class="h-20 border-b border-visionLineGray">
    <div class="flex items-center justify-between">
        <div class="py-4">
            <a href="/" wire:navigate>
                <img width="200px" src="{{ asset('images/LightLogo.svg') }}" alt="VisionIAS Logo" />
            </a>
        </div>

        <div class="flex space-x-5 items-center">
            <button class="flex" onclick="switchLang()">
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
            </svg>

            @guest
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
            @endauth
        </div>
    </div>
</header>

<script type="text/javascript">  
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
</script>
