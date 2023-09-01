<div class="space-y-6">
    <div>
        <h1 class="text-lg font-bold">RELATED VIDEOS</h1>
    </div>

    <div class="flex space-x-5">
        @for($i = 0; $i < 4; $i++)
            <div class="space-y-2">
                <div>
                    <video width="520" height="360" controls>
                        <source src="video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div>
                    <p class="text-visionLineGray font-semibold text-sm">John Jacob - 11/11/23</p>
                </div>
                <div>
                    <p>Amet luctus venenatis lectus magna fringilla urna porttitor rhoncus.</p>
                </div>
            </div>
        @endfor
    </div>
</div>