<div class="relative z-[100]"
    {{ $attributes }}
    x-cloak
    x-transition
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-visionLineGray bg-opacity-75 transition-opacity"></div>
  <div x-data="{ isFullScreen: false }" class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex min-h-[100vh]: md:min-h-full items-end justify-center p-0 md:p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-sm bg-visionGray text-left shadow-xl transition-all h-[100vh] md:h-auto sm:my-8 w-full md:max-w-4xl w-full-90">
        <div class="bg-visionGray dark:bg-dark373839 px-4 pb-4 pt-4 sm:pb-4">
          <div class="sm:flex sm:items-start flex flex-col">
            <div class="flex w-full justify-between border-b border-visionLineGray pb-2">
              <div class="font-bold">
                {{ $heading }}
              </div>
              <div class="flex items-center space-x-2">
                  @if($file)
                    <a href="{{ route('download', ['media' => $file->media?->first()]) }}" class="cursor-pointer">
                      {!! \App\Helpers\SvgIconsHelper::getSvgIcon('download-topic') !!}
                    </a>
                  @endif
                <button @click="{{ $attributes['x-show'] }} = false">
                  {!! \App\Helpers\SvgIconsHelper::getSvgIcon('close-topic-modal') !!}
                </button>
              </div>
            </div>
            <div class="mt-3 flex justify-center sm:mt-0 sm:text-left flex-grow fitscreen w-full">
                {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
