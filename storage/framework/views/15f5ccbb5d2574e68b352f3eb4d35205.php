<?php $__env->startSection('header'); ?>
    <?php if (isset($component)) { $__componentOriginal8f61233c87638e0d3a88c5bac4c4cd29 = $component; } ?>
<?php $component = App\View\Components\Navigation\Topics::resolve(['publishedDate' => $publishedDate,'topics' => $topics] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.topics'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\Topics::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8f61233c87638e0d3a88c5bac4c4cd29)): ?>
<?php $component = $__componentOriginal8f61233c87638e0d3a88c5bac4c4cd29; ?>
<?php unset($__componentOriginal8f61233c87638e0d3a88c5bac4c4cd29); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginald4eb1af78c07bb035ba95fc6fd8a7aa0 = $component; } ?>
<?php $component = App\View\Components\Widgets\OptionsNav::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.options-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\OptionsNav::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald4eb1af78c07bb035ba95fc6fd8a7aa0)): ?>
<?php $component = $__componentOriginald4eb1af78c07bb035ba95fc6fd8a7aa0; ?>
<?php unset($__componentOriginald4eb1af78c07bb035ba95fc6fd8a7aa0); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/layouts/app.blade.php ENDPATH**/ ?>