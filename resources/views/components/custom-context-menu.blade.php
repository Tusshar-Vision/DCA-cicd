<div
  x-data="{ isMenuVisible: false, menuPosition: { top: '0px', left: '0px' } }"
  @contextmenu.prevent="$event.preventDefault();"
  x-on:mouseup="showMenu($event, menuPosition)"
  x-on:click.away="showMenu($event, menuPosition)"
>
 
  <div x-show="isMenuVisible"
    x-bind:style="'top: ' + menuPosition.top + '; left: ' + menuPosition.left"
    class="fixed z-50 bg-visionToolTip border shadow-lg">
    <ul class="flex py-2 text-white">
      <li class="px-4 py-2 hover:bg-visionLineGray cursor-pointer">Copy</li>
      <li class="px-4 py-2 hover:bg-visionLineGray cursor-pointer">Highlight</li>
      <li class="px-4 py-2 hover:bg-visionLineGray cursor-pointer">Add Note</li>
    </ul>
  </div>
  {{ $slot }}
  
<script>
    function showMenu(event, menuPosition) {
        const selection = window.getSelection();
        const selectedText = selection.toString().trim();
        if (selectedText !== '') {
          console.log("I am in if");
            const top = event.clientY + 'px';
            const left = event.clientX + 'px';
            menuPosition.top = top;
            menuPosition.left = left;
            isMenuVisible = true;
            console.log(isMenuVisible);
        } else {
            console.log("I am in else");
            isMenuVisible = false;
            console.log(isMenuVisible);
        }
    }
</script>
</div>