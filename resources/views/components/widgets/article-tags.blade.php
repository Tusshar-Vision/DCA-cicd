<ul class="flex justify-start items-baseline mt-4">
    <li class="text-[#3D3D3D] text-base mr-2 dark:text-white">Tags :</li>
    @foreach ($tags as $tag)
        <li class="mr-2 bg-[#F4F6F8] text-xs rounded-sm py-1 px-2 dark:text-white dark:bg-dark545557">{{ $tag->name }}</li>
    @endforeach
</ul>
