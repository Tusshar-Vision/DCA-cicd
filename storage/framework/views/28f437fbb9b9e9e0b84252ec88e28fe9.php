<?php
    $testSource = "https://www.shutterstock.com/shutterstock/videos/1084218295/preview/stock-footage-futuristic-animated-concept-big-data-center-chief-technology-officer-using-laptop-standing-in.webm";
    $testTitle = "Stock Video For Testing";
?>
<div>
    <div class="vi-title-wrap">
        <h5 class="vi-title">Latest Videos</h5>
        <a href="#" class="vi-view-all">View All</a>
    </div>

    <div class="grid gap-6">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [1, 2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginalb244c2a446c4f61285f5700cca6aca4e = $component; } ?>
<?php $component = App\View\Components\Cards\Video::resolve(['source' => $testSource,'videoTitle' => $testTitle] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.video'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Video::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb244c2a446c4f61285f5700cca6aca4e)): ?>
<?php $component = $__componentOriginalb244c2a446c4f61285f5700cca6aca4e; ?>
<?php unset($__componentOriginalb244c2a446c4f61285f5700cca6aca4e); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/latest-videos.blade.php ENDPATH**/ ?>