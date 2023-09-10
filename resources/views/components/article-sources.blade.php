<div x-data="{ expanded: false }" @click="expanded = ! expanded" :class="{ 'items-center': !expanded }"  class="border-2 border-visionSelectedGray rounded px-4 py-2 flex justify-between cursor-pointer" x-transition>
    <div class="space-y-5">
        <div>
            <h1 class="text-lg font-bold">Sources</h1>
            <p class="text-visionLineGray text-sm">5 sources</p>
        </div>
        <div class="text-visionLineGray text-sm font-light italic flex flex-col space-y-2" x-show="expanded" x-collapse>
            <a href="https://en.wikipedia.org/wiki/Politics_of_India" target="_blank">
                https://en.wikipedia.org/wiki/Politics_of_India
            </a>
            <a href="https://en.wikipedia.org/wiki/Parliamentary_republic">https://en.wikipedia.org/wiki/Parliamentary_republic</a>
            <a href="https://en.wikipedia.org/wiki/Constitutional_monarchy">https://en.wikipedia.org/wiki/Constitutional_monarchy</a>
            <a href="https://en.wikipedia.org/wiki/Monarchy_in_ancient_India">https://en.wikipedia.org/wiki/Monarchy_in_ancient_India</a>
            <a href="https://en.wikipedia.org/wiki/Panchayati_raj">https://en.wikipedia.org/wiki/Panchayati_raj</a>
        </div>
    </div>
    <div>
        <div x-show="expanded === true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
        </div>
        <div x-show="expanded === false">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>
</div>
