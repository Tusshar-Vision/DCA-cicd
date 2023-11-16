<?php $__env->startSection('title', "Home | Current Affairs"); ?>

<?php $__env->startSection('content'); ?>

    <?php if (isset($component)) { $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4 = $component; } ?>
<?php $component = App\View\Components\Containers\GridWide::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('containers.grid-wide'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Containers\GridWide::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-6']); ?>
        <?php if (isset($component)) { $__componentOriginal0585d14be6e66d3beea5f029c675372a = $component; } ?>
<?php $component = App\View\Components\Common\SectionHeading::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Common\SectionHeading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Highlights <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0585d14be6e66d3beea5f029c675372a)): ?>
<?php $component = $__componentOriginal0585d14be6e66d3beea5f029c675372a; ?>
<?php unset($__componentOriginal0585d14be6e66d3beea5f029c675372a); ?>
<?php endif; ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.highlights-section', ['featuredArticles' => $featuredArticles]);

$__html = app('livewire')->mount($__name, $__params, 'WSh4u54', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4 = $component; } ?>
<?php $component = App\View\Components\Containers\GridWide::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('containers.grid-wide'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Containers\GridWide::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-12']); ?>
        <?php if (isset($component)) { $__componentOriginal0585d14be6e66d3beea5f029c675372a = $component; } ?>
<?php $component = App\View\Components\Common\SectionHeading::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Common\SectionHeading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Latest News <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0585d14be6e66d3beea5f029c675372a)): ?>
<?php $component = $__componentOriginal0585d14be6e66d3beea5f029c675372a; ?>
<?php unset($__componentOriginal0585d14be6e66d3beea5f029c675372a); ?>
<?php endif; ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.news-section', ['latestNewsArticles' => $latestNewsArticles]);

$__html = app('livewire')->mount($__name, $__params, 'xMW0YSg', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4 = $component; } ?>
<?php $component = App\View\Components\Containers\GridWide::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('containers.grid-wide'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Containers\GridWide::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-20 flex flex-col items-center']); ?>
        <?php if (isset($component)) { $__componentOriginal0585d14be6e66d3beea5f029c675372a = $component; } ?>
<?php $component = App\View\Components\Common\SectionHeading::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.section-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Common\SectionHeading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-center']); ?>What do you need to learn today? <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0585d14be6e66d3beea5f029c675372a)): ?>
<?php $component = $__componentOriginal0585d14be6e66d3beea5f029c675372a; ?>
<?php unset($__componentOriginal0585d14be6e66d3beea5f029c675372a); ?>
<?php endif; ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.search-bar-with-button', []);

$__html = app('livewire')->mount($__name, $__params, '4kG9gGt', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4 = $component; } ?>
<?php $component = App\View\Components\Containers\GridWide::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('containers.grid-wide'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Containers\GridWide::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'grid grid-cols-4 mt-12 gap-6']); ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.latest-videos', ['latestVideos' => $latestVideos]);

$__html = app('livewire')->mount($__name, $__params, 'TVKjyio', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.latest-downloads', ['latestDownloads' => $latestDownloads]);

$__html = app('livewire')->mount($__name, $__params, 'uug3Pwc', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.leaderboard', ['scoreBoard' => $scoreBoard]);

$__html = app('livewire')->mount($__name, $__params, '22NsciS', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>

    <script>
        // This event is dispatched to reinitialize swiper slider, otherwise it will stop working due to livewire navigation being used in the app.
        window.dispatchEvent(new Event('onHomePage'));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/pages/home.blade.php ENDPATH**/ ?>