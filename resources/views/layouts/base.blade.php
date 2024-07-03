<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="shortcut icon" href="/favicon.ico" />
        <!-- Google Analytics Code - dkjain86@gmail.com ID is used -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-87772028-1', 'auto');
            ga('send', 'pageview',location.pathname);
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-87772028-1"></script>
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=AW-731623325"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-87772028-1');
            gtag('config', 'AW-731623325');
        </script>
        <!-- Facebook Pixel Code -Ajay sir facebook account  -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window,document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '296246770854744');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" src="https://www.facebook.com/tr?id=296246770854744&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-KSNLG48');
        </script>
        <!-- End Google Tag Manager -->

        <meta name="google-signin-scope" content="enquiry@visionias.in">
        <meta name="language" content="en-us">

        <meta name="description" content="Get the latest updates and comprehensive analysis of Current Affairs at Vision IAS, India's premier UPSC coaching institute. Join our Offline & Online General Studies Foundation Course, with One-to-One Mentoring & All India Test Series.">
        <meta name="googlebot" content="Stay ahead with Vision IAS, the best UPSC coaching institute offering comprehensive coverage of Current Affairs through Offline and Online/Live Classes. Access Prelims and Mains Test Series in English and Hindi medium.">
        <meta name="keywords" content="vision ias, upsc coaching, current affairs, daily news, ias preparation, best upsc website, ias study material, ias preparation, best ias coaching, best upsc coaching, top ias institute, upsc online live classes, upsc exam, online ias preparation, upsc prelims preparation, upsc question bank, top UPSC Institute, online ias coaching classes, prelims / mains online offline classes, best prelims test series, online test classes for ias, upsc syllabus, prelims test series, mains test series, current affairs for upsc, upsc toppers answer copy">

        {!! seo() !!}

        <meta name="facebook-domain-verification" content="bwv5x7e78fxfcbzaxf5c2vpgs1wfql">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
        </style>

        @vite('resources/sass/app.scss')
        @livewireStyles
        @yield('styles')
    </head>

    <body x-data="{
        isAuthFormOpen: false,
        isDarkModeEnabled: $persist(false),
        fontSize: 1,
        init() {
            const storedPreference = localStorage.getItem('isDarkModeEnabled');
            if (storedPreference !== null) {
                this.isDarkModeEnabled = storedPreference === 'true';
            } else {
                this.isDarkModeEnabled = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
        }
    }" :class="{ 'dark' : isDarkModeEnabled }">
        <div class="mx-auto w-full px-[20px] lg:px-0 lg:max-w-[90%]">
            <header>
                <x-header />
                <x-navigation.initiatives />
                @yield('header')
            </header>

            <main x-data="{ isNoteOpen: false }">
                @yield('content')
            </main>
        </div>

        <footer>
            @yield('footer')
            <x-footer />
        </footer>

        <x-modals.login-modal x-show="isAuthFormOpen">
            <template x-if="isAuthFormOpen">
                <livewire:widgets.auth-container />
            </template>
        </x-modals.login-modal>
    </body>

    @vite('resources/js/app.js')
    @livewireScripts
    @stack('scripts')
</html>
