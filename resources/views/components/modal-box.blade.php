<div class="relative z-10" 
    {{ $attributes }}  
    x-cloak
    x-transition
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start flex-row-reverse">
            <button @click="isModalOpen = false">
                <svg xmlns="http://www.w3.org/2000/svg" width="17.828" height="17.828">
                    <path d="m2.828 17.828 6.086-6.086L15 17.828 17.828 15l-6.086-6.086 6.086-6.086L15 0 8.914 6.086 2.828 0 0 2.828l6.085 6.086L0 15l2.828 2.828z"/>
                </svg>
            </button>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex-grow">
                {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>