@use('App\Helpers\SvgIconsHelper')

<!-- Slider main container -->
<div class="swiper swiper-featured w-[100%] lg:w-[60%] xl:w-[75%]">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach($featuredArticles as $article)
            <div class="swiper-slide">
                <x-cards.article :article="$article" type="large"/>
            </div>
        @endforeach
    </div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev swiper-nav-button">
        {!! SvgIconsHelper::getSvgIcon('slider-arrow-left') !!}
    </div>
    <div class="swiper-button-next swiper-nav-button">
        {!! SvgIconsHelper::getSvgIcon('slider-arrow-right') !!}
    </div>
</div>
