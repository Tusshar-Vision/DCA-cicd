<?php $__env->startSection('header'); ?>
    <?php if (isset($component)) { $__componentOriginaldc6ebd8460e6a35af8739b41a96b7365 = $component; } ?>
<?php $component = App\View\Components\Header\Archives::resolve(['title' => ''.e($title).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header.archives'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Header\Archives::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc6ebd8460e6a35af8739b41a96b7365)): ?>
<?php $component = $__componentOriginaldc6ebd8460e6a35af8739b41a96b7365; ?>
<?php unset($__componentOriginaldc6ebd8460e6a35af8739b41a96b7365); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/layouts/archive.blade.php ENDPATH**/ ?>