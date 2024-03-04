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
                {{-- <button>Download</button>
                <button>Zoom in and out</button> --}}
                <button @click="{{ $attributes['x-show'] }} = false">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z" fill="black"/>
                  </svg>
                </button>
              </div>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:text-left flex-grow w-full">
                {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
