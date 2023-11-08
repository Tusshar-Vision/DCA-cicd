<div class="col-span-2">
    <div class="vi-title-wrap">
        <h5 class="vi-title">Latest Downloads</h5>
        <a href="#" class="vi-view-all">View All</a>
    </div>

    <div class="columns-2 gap-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [1,2,3,4,5,6]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginalad4a4352a4d325c73a396f1d7d4caecc = $component; } ?>
<?php $component = App\View\Components\Cards\FileDownload::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.file-download'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\FileDownload::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalad4a4352a4d325c73a396f1d7d4caecc)): ?>
<?php $component = $__componentOriginalad4a4352a4d325c73a396f1d7d4caecc; ?>
<?php unset($__componentOriginalad4a4352a4d325c73a396f1d7d4caecc); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/latest-downloads.blade.php ENDPATH**/ ?>