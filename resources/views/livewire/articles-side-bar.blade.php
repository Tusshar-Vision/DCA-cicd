<div class="flex flex-col rounded bg-visionGray">
    <div class="my-8 mx-6">
        <div x-data="{ expanded: false }">
            <button class="flex justify-between items-center w-full" @click="expanded = ! expanded">
                <div x-show="expanded === true" class="flex justify-between items-center w-full">
                    <strong>1. Article</strong>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
                    </svg>
                </div>
                <div x-show="expanded === false" class="flex justify-between items-center w-full">
                    1. Article
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
                    </svg>
                </div>
            </button>
        
            <p x-show="expanded" x-collapse>
                ...
            </p>
        </div>
    </div>
</div>
