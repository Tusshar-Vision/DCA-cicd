<div x-data="{ expanded: false }" @click="expanded = ! expanded" :class="{ 'items-center': !expanded }" class="border-2 border-visionSelectedGray rounded px-4 py-2 flex items-center justify-between cursor-pointer" x-transition>
        <div class="space-y-5 w-full">
            <div>
                <h1 class="text-lg font-bold">Comments</h1>
                <p class="text-visionLineGray text-sm">34 comments</p>
            </div>
            <div class="text-visionLineGray text-sm font-light italic flex flex-col space-y-2" x-show="expanded" x-collapse>
                
            <!-- -->
            <div class="vi-comment-content">
					<div class="create-comment create-comment-first">
						<div class="comment-profile">
							<img src="{{ asset('images/comment-avatar.png') }}" alt="comment">
						</div>
						<div class="comment-text">
							<textarea placeholder="Write your comment"></textarea>
							<button type="submit">Comment</button>
						</div>
					</div>
					<div class="create-comment">
						<div class="comment-profile">
                        <img src="{{ asset('images/comment-avatar.png') }}" alt="comment">
						</div>
						<div class="comment-text submitted-comment">
							<h4>John Doe</h4>
							<em>Jan 11, 2019 at <span>6:19 am</span></em>
							<p class="mt-[8px] text-sm text-[#8F93A3]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<div class="create-comment submitted-secondlabel">
						<div class="comment-profile">
                        <img src="{{ asset('images/comment-avatar.png') }}" alt="comment">
						</div>
						<div class="comment-text submitted-comment">
							<h4>John Doe</h4>
							<em>Jan 11, 2019 at <span>6:19 am</span></em>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<div class="create-comment submitted-secondlabel">
						<div class="comment-profile">
                        <img src="{{ asset('images/comment-avatar.png') }}" alt="comment">
						</div>
						<div class="comment-text submitted-comment">
							<h4>John Doe</h4>
							<em>Jan 11, 2019 at <span>6:19 am</span></em>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
				</div>
            <!-- -->

            </div>
        </div>
    <div>
        <div x-show="expanded === true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
            </svg>
        </div>
        <div x-show="expanded === false">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
            </svg>
        </div>
    </div>
</div>
