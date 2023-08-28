<div class="flex flex-col rounded bg-visionGray">
    <div class="my-8 mx-6">
        <div x-data="{ expanded: false }">
            <button @click="expanded = ! expanded">Article</button>
        
            <p x-show="expanded" x-collapse>
                ...
            </p>
        </div>
    </div>
</div>
