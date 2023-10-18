<div
    x-show="isMenuVisible"
    x-bind:style="'top: ' + menuPosition.top + '; left: ' + menuPosition.left"
    class="fixed z-50 bg-visionToolTip border shadow-lg"
  >
    <ul class="flex py-2 text-white">
      <li class="px-4 py-2 hover:bg-visionLineGray cursor-pointer">Copy</li>
      <li class="px-4 py-2 hover:bg-visionLineGray cursor-pointer">Highlight</li>
      <li class="px-4 py-2 hover:bg-visionLineGray cursor-pointer">Add Note</li>
    </ul>
</div>