<div>
    <div class="flex justify-between items-center w-full mb-4 border p-2">
        <ul class="flex justify-start items-center">
            <a href="#">
                <li class="pr-4">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="16" viewBox="0 0 8 16" fill="none" class="cursor-pointer">
                            <path d="M6.86719 15.0156L0.99998 8.49977" stroke="#242424" class="dark:stroke-white" stroke-linecap="round"/>
                            <line x1="0.5" y1="-0.5" x2="9.61301" y2="-0.5" transform="matrix(-0.654931 0.755689 0.654931 0.755689 7.65625 1.30469)" stroke="#242424" class="dark:stroke-white" stroke-linecap="round"/>
                        </svg>
                        <p class="pl-2">Back</p>
                    </span>
                </li>
            </a>
        </ul>
        <div class="flex">
            <button id="full-screen-btn" class="mr-4">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 3V5H4V9H2V3H8ZM2 21V15H4V19H8V21H2ZM22 21H16V19H20V15H22V21ZM22 9H20V5H16V3H22V9Z" fill="#000" class="dark:fill-white"/>
                </svg>
            </button>
            <button id="full-screen-btn" class="mr-4">
                <svg fill="none" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill-rule="evenodd"><path d="m3 14.25c.41421 0 .75.3358.75.75 0 1.4354.00159 2.4365.10315 3.1919.09865.7338.2791 1.1223.55586 1.3991s.66534.4572 1.39911.5559c.75535.1015 1.75647.1031 3.19188.1031h6c1.4354 0 2.4365-.0016 3.1919-.1031.7338-.0987 1.1223-.2791 1.3991-.5559s.4572-.6653.5559-1.3991c.1015-.7554.1031-1.7565.1031-3.1919 0-.4142.3358-.75.75-.75s.75.3358.75.75v.0549c0 1.3676 0 2.4699-.1165 3.3369-.121.9001-.3799 1.6579-.9818 2.2598-.602.602-1.3598.8609-2.2599.9819-.867.1165-1.9693.1165-3.3369.1165h-6.10977c-1.36759 0-2.46991 0-3.33688-.1165-.90011-.121-1.65798-.3799-2.2599-.9818-.60192-.602-.86081-1.3598-.98183-2.2599-.11656-.867-.11654-1.9693-.11652-3.3369 0-.0183 0-.0366 0-.0549 0-.4142.33579-.75.75-.75z" fill="#000" class="dark:fill-white"/><path d="m12 16.75c.2106 0 .4114-.0885.5535-.2439l4-4.375c.2795-.3057.2583-.7801-.0474-1.0596s-.7801-.2583-1.0596.0474l-2.6965 2.9493v-11.0682c0-.41421-.3358-.75-.75-.75s-.75.33579-.75.75v11.0682l-2.69647-2.9493c-.2795-.3057-.7539-.3269-1.0596-.0474s-.32695.7539-.04745 1.0596l4.00002 4.375c.1421.1554.3429.2439.5535.2439z" fill="#000" class="dark:fill-white"/></g>
                </svg>
            </button>
            <button id="full-screen-btn" class="mr-4">
                <svg width="16" height="16" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_4443_39274)">
                    <path d="M11.8945 9.72656C11.0261 9.72656 10.2609 10.1537 9.78026 10.8034L5.62471 8.67551C5.6937 8.44034 5.74219 8.19662 5.74219 7.93945C5.74219 7.59064 5.67067 7.25903 5.54713 6.95402L9.8961 4.33699C10.3801 4.905 11.0915 5.27344 11.8945 5.27344C13.3485 5.27344 14.5312 4.09069 14.5312 2.63672C14.5312 1.18274 13.3485 0 11.8945 0C10.4406 0 9.25781 1.18274 9.25781 2.63672C9.25781 2.97179 9.32681 3.28963 9.44127 3.58471L5.07935 6.20941C4.59577 5.65828 3.89464 5.30273 3.10547 5.30273C1.65149 5.30273 0.46875 6.48548 0.46875 7.93945C0.46875 9.39343 1.65149 10.5762 3.10547 10.5762C3.98818 10.5762 4.76634 10.1365 5.24517 9.46857L9.38704 11.5895C9.31075 11.8358 9.25781 12.0923 9.25781 12.3633C9.25781 13.8173 10.4406 15 11.8945 15C13.3485 15 14.5312 13.8173 14.5312 12.3633C14.5312 10.9093 13.3485 9.72656 11.8945 9.72656Z" fill="#000" class="dark:fill-white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_4443_39274">
                    <rect width="15" height="15" fill="#000"/>
                    </clipPath>
                    </defs>
                </svg>
            </button>
            <span id="resize-controls" class="">
                <span id="decrease-width" class="cursor-pointer text-[20px]">-</span>
                    <input id="width-percentage" class="text-black w-[70px] font-semibold text-center mx-2 p-[3px] rounded-md" readonly></input>
                <span id="increase-width" class="cursor-pointer text-[20px]">+</span>
            </span>
        </div>
    </div>

    <div class="overflow-auto h-lvh">
        <div id="pdfViewer" class="overflow-auto"></div>
        <div>{!! \App\Helpers\SvgIconsHelper::getSvgIcon('loading-2') !!}</div>
    </div>

    <script src="{{ URL::asset('js/pdf/pdf.mjs') }}" type="module"></script>
    <script type="module">
        var url = "{{ asset('images/test.pdf') }}"
        // url = url.replace(/&amp;/g, "&");

        var { pdfjsLib } = globalThis;
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ URL::asset('js/pdf/pdf.worker.mjs') }}"
        var loadingTask = pdfjsLib.getDocument(url);

        loadingTask.promise.then(function(pdf) {
            var numPages = pdf.numPages;
            var container = document.getElementById('pdfViewer');

            for (var i = 1; i <= numPages; i++) {
              var canvas = document.createElement('canvas');
              canvas.className = 'pdf-page';
              container.appendChild(canvas);
              renderPage(pdf, i, canvas);
            }
        }).catch(function (error) {
            console.error('Error loading PDF: ' + error);
        });

        function renderPage(pdf, pageNumber, canvas) {
            pdf.getPage(pageNumber).then(function(page) {
                var scale = window.innerWidth / page.getViewport({ scale: 1 }).width;
                var viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                var context = canvas.getContext('2d');
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                    renderTask.promise.then(function () {
                });
            });
        }

        document.getElementById('full-screen-btn').addEventListener('click', toggleFullScreen);

        function toggleFullScreen() {
            var pdf_container = document.getElementById('pdfViewer');
            if (!document.fullscreenElement) {
                // If not in full-screen mode, request full screen
                if (pdf_container.requestFullscreen) {
                    pdf_container.requestFullscreen();
                } else if (pdf_container.mozRequestFullScreen) { // Firefox
                    pdf_container.mozRequestFullScreen();
                } else if (pdf_container.webkitRequestFullscreen) { // Chrome, Safari, and Opera
                    pdf_container.webkitRequestFullscreen();
                } else if (pdf_container.msRequestFullscreen) { // IE/Edge
                    pdf_container.msRequestFullscreen();
                }
                if (iconsBtn) {
                    iconsBtn.style.display = 'none';
                }
            } else {
                // If already in full-screen mode, exit full screen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { // Chrome, Safari, and Opera
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
            }
        }
    </script>

    <script>
        function IsMobile() {
            var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            var isTablet = (window.innerWidth > 768); // Adjust the width as needed
            return isMobile && !isTablet;
        }

        var container = document.getElementById('pdfViewer');
        var decreaseButton = document.getElementById('decrease-width');
        var increaseButton = document.getElementById('increase-width');
        var widthInput = document.getElementById('width-percentage');
        var currentWidth = 100;

        decreaseButton.addEventListener('click', decreaseWidth);
        increaseButton.addEventListener('click', increaseWidth);

        function decreaseWidth() {
            if (currentWidth >= 400) {
                currentWidth -= 100;
            } else if (currentWidth > 25) {
                currentWidth -= 25;
            }
            updateContainerWidth();
        }

        var previousWidth = 100;

        widthInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var enteredWidth = parseInt(widthInput.value);
                if (!isNaN(enteredWidth)) {
                    enteredWidth = IsMobile() ?  Math.max(25, Math.min(enteredWidth, 100)) :  Math.max(25, Math.min(enteredWidth, 500));
                    currentWidth = enteredWidth;
                    widthInput.value = currentWidth + '%'; // Add % sign to the input field
                } else {
                    widthInput.value = previousWidth + '%';
                }
                updateContainerWidth(currentWidth);
                previousWidth = currentWidth;
            }
        });

        function increaseWidth() {
            if (currentWidth >= 300 && currentWidth < 500) {
                currentWidth += 100;
            } else if (currentWidth < 300) {
                currentWidth += 25;
            }
            updateContainerWidth();
        }

        function updateContainerWidth() {
            container.style.width = currentWidth + '%';
            widthInput.value = currentWidth + '%';

            if (currentWidth === 100 && !IsMobile()) {
                container.style.padding = '0px 0px';
            } else {
                container.style.padding = '0px';
            }
            if (currentWidth === 25) {
                decreaseButton.classList.add('disabled');
                decreaseButton.style.background = '#7b7a7a'
            } else {
                decreaseButton.classList.remove('disabled');
                decreaseButton.style.background = 'none'
            }
            if (currentWidth === 100 && IsMobile()) {
                increaseButton.classList.add('disabled');
                increaseButton.style.background = '#7b7a7a'
            } else {
                increaseButton.classList.remove('disabled');
                increaseButton.style.background = 'none'
            }
            if (currentWidth === 500 && !IsMobile()) {
                increaseButton.style.background = '#7b7a7a'
                increaseButton.classList.add('disabled');
            }
        }
        updateContainerWidth();
    </script>
</div>
