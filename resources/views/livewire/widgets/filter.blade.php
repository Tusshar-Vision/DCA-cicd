<?php
$year = request()->input('year');
?>

<div x-data="{ isYearOpen: false, isMonthOpen: false }" class="relative flex text-left space-x-4" x-cloak>
  <div>
    <button @click="isYearOpen = !isYearOpen" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-sm bg-white px-3 py-2 text-sm font-semibold text-visionLineGray shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
      Year
      <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>


  <div x-show="isYearOpen" @click.away="isYearOpen = false" class="absolute right-0 top-8 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    <div class="py-1" role="none">
      <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
      <a href="{{request()->url()."?year=2024"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">2024</a>
      <a href="{{request()->url()."?year=2023"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">2023</a>

    </div>
  </div>

@if (request()->is('monthly-magazine*') || request()->is('weekly-focus*') || request()->is('news-today*'))
  <div>
    <button @click="isMonthOpen = !isMonthOpen" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-sm bg-white px-3 py-2 text-sm font-semibold text-visionLineGray shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
      Month
      <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>
  <div x-show="isMonthOpen" @click.away="isMonthOpen = false" class="absolute right-0 top-8 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    <div class="py-1" role="none">
      <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
      <a href="{{$year ? request()->url()."?year=$year&month=1" : request()->url()."?month=1"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">January</a>
      <a href="{{$year ? request()->url()."?year=$year&month=2" : request()->url()."?month=2"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">February</a>
      <a href="{{$year ? request()->url()."?year=$year&month=3" : request()->url()."?month=3"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">March</a>
      <a href="{{$year ? request()->url()."?year=$year&month=4" : request()->url()."?month=4"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">April</a>
      <a href="{{$year ? request()->url()."?year=$year&month=5" : request()->url()."?month=5"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">May</a>
      <a href="{{$year ? request()->url()."?year=$year&month=6" : request()->url()."?month=6"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">June</a>
      <a href="{{$year ? request()->url()."?year=$year&month=7" : request()->url()."?month=7"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">July</a>
      <a href="{{$year ? request()->url()."?year=$year&month=8" : request()->url()."?month=8"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">August</a>
      <a href="{{$year ? request()->url()."?year=$year&month=9" : request()->url()."?month=9"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">September</a>
      <a href="{{$year ? request()->url()."?year=$year&month=10" : request()->url()."?month=10"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">October</a>
      <a href="{{$year ? request()->url()."?year=$year&month=11" : request()->url()."?month=11"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">November</a>
      <a href="{{$year ? request()->url()."?year=$year&month=12" : request()->url()."?month=12"}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">December</a>
    </div>
  </div>
@endif
</div>

