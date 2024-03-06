<div>
<div><button id="full-screen-btn">Fullscreen</button>
<span id="resize-controls">
                <span id="decrease-width" style="cursor:pointer;">
                -
                </span>
                <input id="width-percentage" style="color: black; font-weight:600; width:60px; text-align:center;margin-left:5px;margin-right:5px;border-radius:6px;"></input>
                <span id="increase-width" style="cursor:pointer;">
                +
                </span>
</span>

</div>
<div id="pdfViewer" style="overflow: auto; width: 100%; height: 100%;">
</div>
</div>

<script src="{{URL::asset('js/pdf/pdf.mjs')}}" type="module"></script>
<script type="module">
  var url = "{{URL::asset('images/test.pdf')}}"

  var { pdfjsLib } = globalThis;
  pdfjsLib.GlobalWorkerOptions.workerSrc = "{{URL::asset('js/pdf/pdf.worker.mjs')}}"

  var loadingTask = pdfjsLib.getDocument(url);
  loadingTask.promise.then(function(pdf) {
    console.log('PDF loaded');

    var numPages = pdf.numPages;
    console.log('Number of pages: ' + numPages);
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
      console.log('Page ' + pageNumber + ' loaded');

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
        console.log('Page ' + pageNumber + ' rendered');
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
        if(currentWidth == 100 && !IsMobile()){
          container.style.padding = '0px 40px';
        } else {
          container.style.padding = '0px';
        }
        if(currentWidth == 25){
          decreaseButton.classList.add('disabled');
          decreaseButton.style.background = '#7b7a7a'
        } else{
          decreaseButton.classList.remove('disabled');
          decreaseButton.style.background = 'none'

        }

        if(currentWidth == 100 && IsMobile()){
          increaseButton.classList.add('disabled');
          increaseButton.style.background = '#7b7a7a'
        } else{
          increaseButton.classList.remove('disabled');
          increaseButton.style.background = 'none'
        }

        if(currentWidth == 500 && !IsMobile()){
          increaseButton.style.background = '#7b7a7a'
          increaseButton.classList.add('disabled');
        }
    }
    
    updateContainerWidth();
     

    
    </script>
