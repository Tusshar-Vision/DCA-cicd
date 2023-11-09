<?php $__env->startSection('title', 'Mains 365 | Current Affairs'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal4e38bba42a1d2bbddf2edbdc8d9246ea = $component; } ?>
<?php $component = App\View\Components\Widgets\DownloadSection::resolve(['year' => '2023'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.download-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\DownloadSection::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4e38bba42a1d2bbddf2edbdc8d9246ea)): ?>
<?php $component = $__componentOriginal4e38bba42a1d2bbddf2edbdc8d9246ea; ?>
<?php unset($__componentOriginal4e38bba42a1d2bbddf2edbdc8d9246ea); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.archive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/pages/mains-365.blade.php ENDPATH**/ ?>