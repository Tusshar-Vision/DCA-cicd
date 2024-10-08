@php
    $currentYear = request()->input('year');
    $currentMonth = request()->input('month');
@endphp

<div x-data="{ isYearOpen: false, isMonthOpen: false }" class="relative flex items-center text-left space-x-4" x-cloak>
  <div class="relative">
    <div>
        <button @click="isYearOpen = !isYearOpen" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-sm bg-white px-3 py-2 text-sm font-semibold text-visionLineGray shadow-sm ring-1 ring-inset ring-gray-300 dark:bg-dark545557" id="menu-button" aria-expanded="true" aria-haspopup="true">
          {{$currentYear ?? "Year"}}
          <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
          </svg>
        </button>
    </div>
    <div x-show="isYearOpen" @click.away="isYearOpen = false" class="absolute right-0 top-8 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-dark545557 dark:ring-gray-300" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
          <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
          @foreach ($data as $year)
              <a href="{{request()->url()."?year=$year"}}" class="text-gray-700 dark:text-white block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>{{$year}}</a>
          @endforeach
        </div>
    </div>
  </div>
  <div class="relative">
    @if (request()->is('monthly-magazine*') || request()->is('weekly-focus*') || request()->is('news-today*'))
      <div>
        <button @click="isMonthOpen = !isMonthOpen" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-sm bg-white px-3 py-2 text-sm font-semibold text-visionLineGray shadow-sm ring-1 ring-inset ring-gray-300 dark:bg-dark545557" id="menu-button" aria-expanded="true" aria-haspopup="true">
          {{$currentMonth ? date('F', mktime(0, 0, 0, $currentMonth, 1)) :  "Month"}}
          <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
      <div x-show="isMonthOpen" @click.away="isMonthOpen = false" class="absolute right-0 top-8 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:ring-gray-300 dark:bg-dark545557" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
          <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=1" : request()->url()."?month=1"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>January</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=2" : request()->url()."?month=2"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>February</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=3" : request()->url()."?month=3"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>March</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=4" : request()->url()."?month=4"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>April</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=5" : request()->url()."?month=5"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>May</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=6" : request()->url()."?month=6"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>June</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=7" : request()->url()."?month=7"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>July</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=8" : request()->url()."?month=8"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>August</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=9" : request()->url()."?month=9"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>September</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=10" : request()->url()."?month=10"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>October</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=11" : request()->url()."?month=11"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>November</a>
          <a href="{{$currentYear ? request()->url()."?year=$currentYear&month=12" : request()->url()."?month=12"}}" class="text-gray-700 dark:text-visionGray block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:navigate>December</a>
        </div>
      </div>
  </div>
    @endif

    @if ($currentYear || $currentMonth)
        <div class="flex justify-center items-center">
            <a href="{{ request()->url() }}" class="text-md cursor-pointer text-visionBlue hover:text-visionRed dark:hover:text-white dark:text-[#ccc]" wire:navigate>Clear</a>
        </div>
    @endif
</div>

