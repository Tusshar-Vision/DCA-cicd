<div {{ $attributes }} x-cloak class="relative">
    <ul class="absolute font-normal bg-white border shadow rounded-sm mt-2 py-1 z-20 right-0 top-4 min-w-[150px] dark:text-white dark:bg-dark545557 border-[#686E70]">
        <li class="relative">
            <a href="{{ route('user.dashboard') }}" @click.outside="isUserMenuOpen = false"
               class="flex items-center justify-between px-3 py-2 hover:text-[#3362CC]"
               wire:navigate
            >
                My Dashboard
            </a>
            <a href="#" @click.outside="isUserMenuOpen = false"
               class="flex items-center justify-between px-3 py-2 hover:text-[#3362CC]"
               wire:navigate
            >
                Profile Settings
            </a>
            <a href="{{ route('logout') }}" @click.outside="isUserMenuOpen = false"
               class="flex items-center justify-between px-3 py-2 hover:text-[#3362CC]"
               wire:navigate
            >
                Logout
            </a>
        </li>
    </ul>
</div>
