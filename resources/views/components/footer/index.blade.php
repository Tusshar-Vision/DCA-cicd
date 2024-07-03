@php
    use App\Helpers\UrlHelper;
    use App\Helpers\SvgIconsHelper;
    use Carbon\Carbon;
@endphp

<div class="flex w-full flex-col md:justify-between justify-center bg-visionGray mt-14 dark:bg-darkMode">
    <div class="flex flex-col 2xl:flex-row border-b-2 border-gray-300 mt-14 justify-between mx-auto w-full px-[20px] lg:px-0 lg:max-w-[90%] pb-[25px]">
        <div class="flex flex-col md:mb-4 xl:mb-0">
            <div class="m-auto md:m-0 text-center">
                <a href="{{ UrlHelper::linkToVision('/') }}" class="inline-block">
                    <img class="w-60 dark:hidden" src="{{ asset('images/LightLogo-bkp.svg') }}" alt="VisionIAS Logo" />
                    <img class="w-60 hidden dark:block" src="{{ asset('images/DarkLogo-bkp.svg') }}" alt="Dark VisionIAS Logo" />
                </a>
            </div>

            <div class="flex flex-col text-center 2xl:text-justify text-sm pb-4 mt-4">
                <span>
                    <h5 class="text-gray-400">{{ __('footer.call_us') }}</h5>
                    <p class="text-sm">
                        <a href="tel:+91 901 906 6066" class="hover:text-[#005FAF] lg:inline-block">+91 8468022022</a></p>
                    </p>
                </span>
                <span>
                    <h5 class="text-gray-400 mt-2">{{ __('footer.email_us') }}</h5>
                    <p class="text-sm">
                        <a href="mailto:enquiry@visionias.in" class="hover:text-[#005FAF]">enquiry@visionias.in</a>
                    </p>

                </span>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between md:space-x-8 2xl:space-x-28 mt-[25px]">
            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">COURSES</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">COURSES<span class="plus block md:hidden">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="{{ UrlHelper::linkToVision('/') }}" class="text-sm hover:text-[#005FAF]">Home</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/#classroom') }}" class="text-sm hover:text-[#005FAF]">Classroom</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/testseries') }}" class="text-sm hover:text-[#005FAF]">Mains Test Series</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/testseries') }}" class="text-sm hover:text-[#005FAF]">Prelims Test Series</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/interview') }}" class="text-sm hover:text-[#005FAF]">Interview</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/lakshya') }}" class="text-sm hover:text-[#005FAF]">Lakshya</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/daksha') }}" class="text-sm hover:text-[#005FAF]">Daksha</a></li>

                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/essay') }}" class="text-sm hover:text-[#005FAF]">Essay</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/csat') }}" class="text-sm hover:text-[#005FAF]">CSAT</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/mainsadvance') }}" class="text-sm hover:text-[#005FAF]">GS Mains Advance</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/fasttrack') }}" class="text-sm hover:text-[#005FAF]">Fast Track - Prelims</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/register/classroom/4692') }}" class="text-sm hover:text-[#005FAF]">Hindi FC</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/pt365') }}" class="text-sm hover:text-[#005FAF]">PT 365</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/mains365') }}" class="text-sm hover:text-[#005FAF]">Mains 365</a></li>
                    <li class="block md:hidden"><a href="{{ UrlHelper::linkToVision('/mcar') }}" class="text-sm hover:text-[#005FAF]">Monthly CA</a></li>
                </ul>
            </div>

            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0 hidden md:block">
                <ul class="space-y-2 hidden md:block mt-8">
                    <li><a href="{{ UrlHelper::linkToVision('/essay') }}" class="text-sm hover:text-[#005FAF]">Essay</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/csat') }}" class="text-sm hover:text-[#005FAF]">CSAT</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/mainsadvance') }}" class="text-sm hover:text-[#005FAF]">GS Mains Advance</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/fasttrack') }}" class="text-sm hover:text-[#005FAF]">Fast Track - Prelims</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/register/classroom/4692') }}" class="text-sm hover:text-[#005FAF]">Hindi FC</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/pt365') }}" class="text-sm hover:text-[#005FAF]">PT 365</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/mains365') }}" class="text-sm hover:text-[#005FAF]">Mains 365</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/mcar') }}" class="text-sm hover:text-[#005FAF]">Monthly CA</a></li>
                </ul>
            </div>

            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">Services</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">Services<span class="plus block md:hidden">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="{{ UrlHelper::linkToVision('/resources') }}" class="text-sm hover:text-[#005FAF]">Resources</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/abhyaas') }}" class="text-sm hover:text-[#005FAF]">Abhyaas</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/opentest') }}" class="text-sm hover:text-[#005FAF]">Open Test</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/blog') }}" class="text-sm hover:text-[#005FAF]">Blog</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/onlinedemo_test') }}" class="text-sm hover:text-[#005FAF]">Classroom Demo</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/campus-ambassador') }}" class="text-sm hover:text-[#005FAF]">Campus Ambassador</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/pratispardha') }}" class="text-sm hover:text-[#005FAF]">Pratispardha</a></li>
                </ul>
            </div>
            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">Company</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">Company <span class="plus block md:hidden">+</span></h5>

                <ul class="space-y-2 hidden md:block">
{{--                    <li><a href="{{ UrlHelper::linkToVision('/about-us') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.about_us')}}</a></li>--}}
                    <li><a href="{{ UrlHelper::linkToVision('/#centers') }}" class="text-sm hover:text-[#005FAF]">Our Centers</a></li>
{{--                    <li><a href="{{ UrlHelper::linkToVision('/contact-us') }}" class="text-sm hover:text-[#005FAF]">Contact Us</a></li>--}}
{{--                    <li><a href="{{ UrlHelper::linkToVision('/faq') }}" class="text-sm hover:text-[#005FAF]">FAQ</a></li>--}}
{{--                    <li><a href="{{ UrlHelper::linkToVision('/syllabus') }}" class="text-sm hover:text-[#005FAF]">Syllabus</a></li>--}}
                </ul>
            </div>
            <div class="space-y-2 border-t-[1px] md:border-t-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">{{__('footer.policy')}}</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">{{__('footer.policy')}} <span class="plus">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="{{ UrlHelper::linkToVision('/terms-of-use') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.terms_of_use')}}</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/privacy') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.privacy_policy')}}</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/refund') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.refund_policy')}}</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/data-policy') }}" class="text-sm hover:text-[#005FAF]">Data Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mx-auto w-full lg:max-w-[90%] mt-8 border-b-2 border-gray-300 pb-8 px-[20px] lg:px-0">
        <div class="mb-4">
            <h4 class="font-bold font-sans text-base md:text-xl mb-2">About UPSC Civil Services Examination (UPSC CSE)</h4>
            <p>The UPSC Civil Services Examination (CSE) is one of India's most prestigious tests, aimed at selecting candidates for diverse civil services roles such as IAS, IPS, and IFS. Administered annually by the UPSC, this examination is known for its rigorous selection procedure, encompassing Prelims, Mains, and a Personality Test/Interview.</p>
        </div>
        <div class="mb-4">
            <h4 class="font-bold font-sans text-base md:text-xl mb-2">Skills Required to Excel in UPSC CSE</h4>
            <p>The preliminary stage gauges foundational knowledge and cognitive abilities to identify serious aspirants for the Mains Examination. The Mains examination evaluates the aspirant's ability to think critically, analyze complex issues, and communicate effectively through coherent and compelling answer writing. The final phase, i.e. Interviews, assesses an aspirant's intellectual and social traits that reflect their ability to interact effectively with diverse groups and their readiness for a career in Civil Services.</p>
        </div>
        <div class="mb-4">
            <h4 class="font-bold font-sans text-base md:text-xl mb-2">Achieving Success with VisionIAS</h4>
            <p class="mb-4">Through its diverse range of initiatives and services, VisionIAS offers a holistic guidance and preparation platform for civil services aspirants, helping them cultivate the skills and competencies essential for success in the UPSC CSE, whether it's the Prelims, the Mains, or the Personality Test.</p>

            <p class="mb-4">This support encompasses highly innovative UPSC Classes, available through both online and offline/classroom ecosystems, enabling students to achieve optimal learning outcomes. VisionIAS offers its renowned All India UPSC Mock Test Series for GS Prelims, Mains, CSAT, Essay, and Optional Subjects, ensuring ongoing assessment and continuous enhancement of student performance.</p>

            <p class="mb-4">A dedicated and dynamic Mentoring ecosystem provides personalized guidance to help students identify their growth areas and offers specific inputs that empower them to maximize their potential and achieve success.</p>

            <p class="mb-4">VisionIAS stands out as one of the best IAS academies in the country due to its extensive physical presence in over 10 cities and its nationwide online reach. The institute's pioneering innovations in UPSC online coaching, providing real-time support to students, set it apart in Civil Services guidance and support, helping students realize their dream of joining Civil Services to serve the nation.</p>
        </div>
        <div class="mb-4">
            <h4 class="font-bold font-sans text-base md:text-xl mb-2">Become a part of the VisionIAS Community.</h4>
            <p>Stay informed about crucial UPSC preparation updates. Connect with the VisionIAS community on social media to remain engaged with our informative and collaborative network.</p>
        </div>

        <div class="flex space-x-3 justify-center md:justify-start mt-8">
            <a href="{{ UrlHelper::linkToSocial('whatsapp') }}" target="_blank">
                <span>
                    {!! SvgIconsHelper::getSvgIcon('whatsapp-footer') !!}
                </span>
            </a>

            <a href="{{ UrlHelper::linkToSocial('telegram') }}" target="_blank">
                <span>
                    {!! SvgIconsHelper::getSvgIcon('telegram-footer') !!}
                </span>
            </a>

            <a href="{{ UrlHelper::linkToSocial('facebook') }}" target="_blank">
                <span>
                    {!! SvgIconsHelper::getSvgIcon('facebook-footer') !!}
                </span>
            </a>

            <a href="{{ UrlHelper::linkToSocial('twitter') }}" target="_blank">
                <span>
                    {!! SvgIconsHelper::getSvgIcon('twitter-footer') !!}
                </span>
            </a>

            <a href="{{ UrlHelper::linkToSocial('youtube') }}" target="_blank">
                <span>
                    {!! SvgIconsHelper::getSvgIcon('youtube-footer') !!}
                </span>
            </a>

            <a href="{{ UrlHelper::linkToSocial('instagram') }}" target="_blank">
                <span>
                    {!! SvgIconsHelper::getSvgIcon('instagram-footer') !!}
                </span>
            </a>
        </div>
    </div>

    <div class="flex justify-center my-[35px]">
        <h6 class="italic text-center">© {{ Carbon::now()->year . ' ' . __('footer.copy_right')}}.</h6>
    </div>
</div>

<script>

function toggleList(element) {
    const content = element.nextElementSibling;
    const plus = element.querySelector('.plus');

    if (content.style.display === 'block') {
      content.style.display = 'none';
      plus.style.transform = 'rotate(0deg)';
    } else {
      content.style.display = 'block';
      plus.style.transform = 'rotate(45deg)';
    }
  }
</script>
