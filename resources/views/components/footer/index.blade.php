@php
    use App\Helpers\UrlHelper;
    use App\Helpers\SvgIconsHelper;
    use Carbon\Carbon;
@endphp

<div class="flex w-full flex-col md:justify-between justify-center bg-visionGray mt-14">
    <div class="flex flex-col md:flex-row border-b-2 border-gray-300 mt-14 justify-between mx-auto w-full px-[20px] lg:px-0 lg:max-w-[90%] pb-[25px]">
        <div class="flex flex-col space-y-8">
            <div class="m-auto md:m-0">
                <a href="{{ UrlHelper::linkToVision('/') }}">
                    {!! SvgIconsHelper::getSvgIcon('vision-footer-logo') !!}
                </a>
            </div>

            {{-- <div class="flex space-x-3 justify-center md:justify-start">
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
            </div> --}}

            <div class="flex flex-col text-center md:text-justify text-sm pb-4">
                <span>
                    <h5 class="text-gray-400">{{ __('footer.call_us') }}</h5>
                    <p class="text-sm">
                        {{-- <a href="tel:+91 846 802 2022" class="hover:text-[#005FAF] lg:inline-block">+91 846 802 2022,</a>
                        <a href="tel:+91 901 906 6066" class="hover:text-[#005FAF] lg:inline-block">+91 901 906 6066</a> --}}
                        <a href="tel:+91 901 906 6066" class="hover:text-[#005FAF] lg:inline-block">+91 8468022022</a></p>
                    </p>
                </span>
                {{-- <span class="hidden md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2" height="38" viewBox="0 0 2 38" fill="none">
                        <path d="M1 0V38" stroke="#8F93A3"/>
                    </svg>
                </span> --}}
                <span>
                    <h5 class="text-gray-400 mt-2">{{ __('footer.email_us') }}</h5>
                    <p class="text-sm">
                        <a href="mailto:enquiry@visionias.in" class="hover:text-[#005FAF]">enquiry@visionias.in</a>
                    </p>

                </span>
            </div>
        </div>
        <div class="flex flex-col md:flex-row space-x-0 md:space-x-28 mt-[25px] md:mt-0">
            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">COURSES</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">COURSES<span class="plus block md:hidden">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Home</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Classroom</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Mains Test Series</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Prelims Test Series</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Interview</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Lakshya</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Daksha</a></li>

                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Essay</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">CSAT</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">GS Mains Advance</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Fast Track - Prelims</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Hindi FC</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">PT 365</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Mains 365</a></li>
                    <li class="block md:hidden"><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Monthly CA</a></li>
                </ul>
            </div>
            
            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0 hidden md:block">
                <ul class="space-y-2 hidden md:block mt-8">
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Essay</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">CSAT</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">GS Mains Advance</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Fast Track - Prelims</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Hindi FC</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">PT 365</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Mains 365</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Monthly CA</a></li>
                </ul>
            </div>

            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">Services</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">Services<span class="plus block md:hidden">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Resources</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Abhyaas</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Open Test</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Blog</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Classroom Demo</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Campus Ambassador</a></li>
                </ul>
            </div>
            <div class="space-y-2 border-t-[1px] border-b-[1px] md:border-t-0 md:border-b-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">Company</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">Company <span class="plus block md:hidden">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="{{ UrlHelper::linkToVision('/about-us') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.about_us')}}</a></li>
                    {{-- <li><a href="{{ UrlHelper::linkToVision('/centers') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.locations')}}</a></li> --}}
                    {{-- <li><a href="{{ UrlHelper::linkToVision('/contact-us') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.contact_us')}}</a></li> --}}
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Our Centers</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Contact Us</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">FAQ</a></li>
                    <li><a href="javascript:void(0)" class="text-sm hover:text-[#005FAF]">Syllabus</a></li>
                </ul>
            </div>
            <div class="space-y-2 border-t-[1px] md:border-t-0 py-[15px] md:py-0">
                <h5 class="font-bold hidden md:block uppercase">{{__('footer.policy')}}</h5>
                <h5 class="font-bold flex justify-between md:hidden uppercase" onclick="toggleList(this)">{{__('footer.policy')}} <span class="plus">+</span></h5>

                <ul class="space-y-2 hidden md:block">
                    <li><a href="{{ UrlHelper::linkToVision('/terms-of-use') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.terms_of_use')}}</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/privacy') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.privacy_policy')}}</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/refund-policy') }}" class="text-sm hover:text-[#005FAF]">{{__('footer.refund_policy')}}</a></li>
                    <li><a href="{{ UrlHelper::linkToVision('/terms-of-use') }}" class="text-sm hover:text-[#005FAF]">Data Policy</a></li>
                </ul>
            </div>
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
