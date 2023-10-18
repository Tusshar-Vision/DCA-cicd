<div class="space-y-6">
    <div>
        <h1 class="text-lg font-bold">RELATED VIDEOS</h1>
    </div>

    <div class="flex flex-col space-y-5">
        @for($i = 0; $i < 5; $i++)
            <div class="flex space-x-2">
                <div>
                    <video width="320" height="360" controls>
                        <source src="video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <!-- <div>
                    <p class="text-visionLineGray font-semibold text-sm">John Jacob - 11/11/23</p>
                </div> -->
                <div>
                    <p class="text-sm">Amet luctus venenatis lectus magna fringilla urna porttitor rhoncus.</p>
                </div>
            </div>
        @endfor
    </div>
</div>