<div>
    <?php if (isset($component)) { $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4 = $component; } ?>
<?php $component = App\View\Components\Containers\GridWide::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('containers.grid-wide'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Containers\GridWide::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginalda6e8508251cfbde75378c68b51244d9 = $component; } ?>
<?php $component = App\View\Components\Common\SubHeading::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.sub-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Common\SubHeading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'my-5']); ?><?php echo e($year); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda6e8508251cfbde75378c68b51244d9)): ?>
<?php $component = $__componentOriginalda6e8508251cfbde75378c68b51244d9; ?>
<?php unset($__componentOriginalda6e8508251cfbde75378c68b51244d9); ?>
<?php endif; ?>

        <div class="grid grid-cols-4 gap-6">
            <?php if (isset($component)) { $__componentOriginal407d50f37428cf1a60789ec1f35f32d2 = $component; } ?>
<?php $component = App\View\Components\Widgets\WeeklyFocusArchive::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.weekly-focus-archive'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\WeeklyFocusArchive::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal407d50f37428cf1a60789ec1f35f32d2)): ?>
<?php $component = $__componentOriginal407d50f37428cf1a60789ec1f35f32d2; ?>
<?php unset($__componentOriginal407d50f37428cf1a60789ec1f35f32d2); ?>
<?php endif; ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/weekly-focus-archive-section.blade.php ENDPATH**/ ?>