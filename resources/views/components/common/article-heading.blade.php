<span x-show="!isSidePanelOpen" @click="isSidePanelOpen = !isSidePanelOpen" x-cloak>Expand</span>
<span x-show="isSidePanelOpen" @click="isSidePanelOpen = !isSidePanelOpen" x-cloak>Collapse</span>
<h1 class="text-left text-xl lg:text-4xl">{{ $title }}</h1>
