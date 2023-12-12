@php
    use Illuminate\Support\Str;
    $counter = 1;
    $currentArticle = request()->segment(4);
@endphp

<div class="flex flex-col rounded bg-visionGray pb-4">
    <div class="my-4 mx-6">
        <h4 class="font-bold text-base[16px] py-[16px] border-bottom">Table of Content</h4>
        <div>
            <ol class="ml-[24px] list-decimal">
                <li class="py-[15px] border-bottom hover:brand-color"><a href="#" class="block text-base[16px] font-medium black-040404 hover:brand-color">What Is Ethereum 2.0?</a></li>
                <li class="py-[15px] border-bottom hover:brand-color"><a href="#" class="block text-base[16px] font-medium black-040404 hover:brand-color">What Is Ethereum 2.0?</a></li>
                <li class="py-[15px] border-bottom hover:brand-color"><a href="#" class="block text-base[16px] font-medium black-040404 hover:brand-color">What Is Ethereum 2.0?</a></li>
            </ol>
        </div>
    </div>
</div>
