<a href="{{ route($link) }}" {{ $navigate ? 'wire:navigate' : ''}}>
    <div class="group bg-[#F8FAFD] dark:bg-[#292929] dark:border p-[20px] rounded hover:cursor-pointer">
        <img src="{{ asset('images/icons/' . $icon ) }}" alt="{{ $title }}" class="mb-4 group-hover:scale-105 transition-all object-cover">
        <h3 class="text-[18px] text-[#040404] mb-4 dark:text-white">{{ $title }}</h3>
        <p class="text-[#8F93A3] text-[14px] dark:text-visionGray">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
    </div>
</a>
