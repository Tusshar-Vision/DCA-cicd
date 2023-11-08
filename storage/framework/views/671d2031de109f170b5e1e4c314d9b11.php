<div class="flex justify-between gap-10 mt-6" wire:poll.120s="getData">
    <?php if (isset($component)) { $__componentOriginala7af1bb5c78d8559dffb63d05de46101 = $component; } ?>
<?php $component = App\View\Components\Widgets\HighlightsSlider::resolve(['featuredArticles' => $featuredArticles] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.highlights-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\HighlightsSlider::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala7af1bb5c78d8559dffb63d05de46101)): ?>
<?php $component = $__componentOriginala7af1bb5c78d8559dffb63d05de46101; ?>
<?php unset($__componentOriginala7af1bb5c78d8559dffb63d05de46101); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal18915256a0bc2d4a0dc952b76731d148 = $component; } ?>
<?php $component = App\View\Components\Widgets\HighlightsSidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.highlights-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\HighlightsSidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18915256a0bc2d4a0dc952b76731d148)): ?>
<?php $component = $__componentOriginal18915256a0bc2d4a0dc952b76731d148; ?>
<?php unset($__componentOriginal18915256a0bc2d4a0dc952b76731d148); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/highlights-section.blade.php ENDPATH**/ ?>