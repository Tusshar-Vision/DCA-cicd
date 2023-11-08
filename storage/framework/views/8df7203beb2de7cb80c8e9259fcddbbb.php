<div class="fi-resource-relation-manager flex flex-col gap-y-6">
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.resources.tabs','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::resources.tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.relation-manager.before', scopes: $this->getRenderHookScopes())); ?>


    <?php echo e($this->table); ?>


    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.relation-manager.after', scopes: $this->getRenderHookScopes())); ?>

</div>
<?php /**PATH /home/yash/vision-ca-api/vendor/filament/filament/src/../resources/views/resources/relation-manager.blade.php ENDPATH**/ ?>