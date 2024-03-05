<div class="relative z-10"
    {{ $attributes }}
    x-cloak
    x-transition
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-visionLineGray bg-opacity-75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex min-h-[100vh]: md:min-h-full items-end justify-center p-0 md:p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-sm bg-visionGray text-left shadow-xl transition-all h-[100vh] md:h-auto sm:my-8 w-full md:max-w-4xl">
        <div class="bg-visionGray px-4 pb-4 pt-4 sm:pb-4">
          <div class="sm:flex sm:items-start flex flex-col">
            <div class="flex w-full justify-between border-b border-visionLineGray pb-2">
              <div class="font-bold">
                {{ $heading }}
              </div>
              <div>
                <button class="cursor-pointer">
                  {!! \App\Helpers\SvgIconsHelper::getSvgIcon('download-topic') !!}
                </button>
                <button id="showButton" class="cursor-pointer md:hidden">
                  {!! \App\Helpers\SvgIconsHelper::getSvgIcon('fullscreen') !!}
                </button>
                <button id="hideButton" class="hidden cursor-pointer md:hidden">
                  {!! \App\Helpers\SvgIconsHelper::getSvgIcon('fullscreen-remove') !!}
                </button>
                <button @click="{{ $attributes['x-show'] }} = false">
                  {!! \App\Helpers\SvgIconsHelper::getSvgIcon('close-topic-modal') !!}
                </button>
              </div>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:text-left flex-grow fitscreen w-full" id="target">
                {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      var targetDiv = document.getElementById('target');
      var showButton = document.getElementById('showButton');
      var hideButton = document.getElementById('hideButton');

      // Add event listener to the show button
      showButton.addEventListener('click', function() {
          targetDiv.classList.add('w-full-90');
          showButton.classList.add('hidden');
          hideButton.classList.remove('hidden');
      });

      // Add event listener to the hide button
      hideButton.addEventListener('click', function() {
          targetDiv.classList.remove('w-full-90');
          hideButton.classList.add('hidden');
          showButton.classList.remove('hidden');
      });
    });
</script>
