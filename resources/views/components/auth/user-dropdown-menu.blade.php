<div {{ $attributes }} x-cloak>
    <ul class="absolute font-normal bg-visionGray shadow rounded-sm border mt-2 py-1 z-20 right-6 top-14">
        <li class="relative">
            <a  href="#" 
                @click.outside="isUserMenuOpen = false" 
                class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray"
            >
                My Dashboard
            </a>
            <a  href="#" 
                @click.outside="isUserMenuOpen = false" 
                class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray"
            >
                Profile Settings
            </a>
            <a  href="{{ route('logout') }}" 
                @click.outside="isUserMenuOpen = false" 
                class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray"
            >
                Logout
            </a>
        </li>
    </ul>
</div>