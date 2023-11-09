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

        <div class="card-listing">
            <?php $__currentLoopData = [1,2,3,4,5,6,7]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66 = $component; } ?>
<?php $component = App\View\Components\Cards\Download::resolve(['title' => 'Government Schemes Comprehensive Part 2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.download'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Download::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66)): ?>
<?php $component = $__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66; ?>
<?php unset($__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66 = $component; } ?>
<?php $component = App\View\Components\Cards\Download::resolve(['title' => 'Government Schemes in News'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.download'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Download::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66)): ?>
<?php $component = $__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66; ?>
<?php unset($__componentOriginalb5f04971fd5f4d6943a1f2546ec27c66); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/widgets/download-section.blade.php ENDPATH**/ ?>