<div class="relative z-10"
     {{ $attributes }}
     x-cloak
     x-transition
     aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-visionLineGray bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-md bg-white shadow-xl transition-all w-7/12">

                            
                <button @click="{{ $attributes['x-show'] }} = false" class="absolute right-3 top-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <g clip-path="url(#clip0_930_4385)">
                            <path d="M12.5 0.75C10.1761 0.75 7.90433 1.43913 5.97206 2.73023C4.03978 4.02134 2.53375 5.85644 1.64442 8.00347C0.755091 10.1505 0.522402 12.513 0.975778 14.7923C1.42915 17.0716 2.54823 19.1652 4.1915 20.8085C5.83477 22.4518 7.92842 23.5709 10.2077 24.0242C12.487 24.4776 14.8495 24.2449 16.9965 23.3556C19.1436 22.4663 20.9787 20.9602 22.2698 19.028C23.5609 17.0957 24.25 14.8239 24.25 12.5C24.2465 9.38478 23.0074 6.39817 20.8046 4.19537C18.6018 1.99258 15.6152 0.753511 12.5 0.75ZM12.5 23.25C10.3739 23.25 8.29545 22.6195 6.52763 21.4383C4.7598 20.2571 3.38194 18.5782 2.5683 16.6138C1.75466 14.6495 1.54177 12.4881 1.95656 10.4028C2.37135 8.31748 3.39519 6.40202 4.89861 4.8986C6.40202 3.39519 8.31749 2.37135 10.4028 1.95656C12.4881 1.54177 14.6495 1.75465 16.6139 2.5683C18.5782 3.38194 20.2571 4.75979 21.4383 6.52762C22.6195 8.29545 23.25 10.3739 23.25 12.5C23.2468 15.3501 22.1132 18.0825 20.0978 20.0978C18.0825 22.1132 15.3501 23.2468 12.5 23.25Z" fill="#242424"/>
                            <path d="M16.5997 8.40027C16.5533 8.35383 16.4982 8.31699 16.4376 8.29186C16.3769 8.26672 16.3119 8.25378 16.2462 8.25378C16.1806 8.25378 16.1156 8.26672 16.0549 8.29186C15.9942 8.31699 15.9391 8.35383 15.8927 8.40027L12.4999 11.793L9.10707 8.40027C9.01325 8.30681 8.88618 8.25439 8.75375 8.25451C8.62132 8.25464 8.49435 8.3073 8.40071 8.40094C8.30707 8.49459 8.2544 8.62155 8.25428 8.75398C8.25415 8.88641 8.30657 9.01348 8.40004 9.1073L11.7928 12.5L8.40004 15.8927C8.35347 15.9391 8.3165 15.9942 8.29126 16.0549C8.26602 16.1156 8.25299 16.1807 8.25293 16.2464C8.25287 16.3121 8.26577 16.3772 8.29089 16.438C8.31602 16.4987 8.35288 16.5539 8.39936 16.6004C8.44584 16.6469 8.50103 16.6837 8.56177 16.7089C8.62252 16.734 8.68762 16.7469 8.75335 16.7468C8.81909 16.7468 8.88416 16.7338 8.94486 16.7085C9.00555 16.6833 9.06067 16.6463 9.10707 16.5997L12.4999 13.207L15.8927 16.5997C15.9865 16.6932 16.1136 16.7456 16.246 16.7455C16.3785 16.7454 16.5054 16.6927 16.5991 16.5991C16.6927 16.5054 16.7454 16.3784 16.7455 16.246C16.7456 16.1136 16.6932 15.9865 16.5997 15.8927L13.2069 12.5L16.5997 9.1073C16.6462 9.06089 16.683 9.00577 16.7082 8.94512C16.7333 8.88446 16.7462 8.81944 16.7462 8.75379C16.7462 8.68813 16.7333 8.62311 16.7082 8.56245C16.683 8.5018 16.6462 8.44669 16.5997 8.40027Z" fill="#242424"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_930_4385">
                            <rect width="25" height="25" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                    
                
                <div class="mt-3 text-center sm:mt-0 sm:text-left flex-grow w-full">
                    {{ $slot }}
                </div>

            </div>
        </div>
    </div>
</div>