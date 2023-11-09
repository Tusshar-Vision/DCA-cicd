<?php $__env->startSection('title', "Monthly Magazine Archive | Current Affairs"); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4 = $component; } ?>
<?php $component = App\View\Components\Containers\GridWide::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('containers.grid-wide'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Containers\GridWide::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-[32px]']); ?>
    <div class="columns-4 gap-6">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.monthly-focus', ['year' => '2023']);

$__html = app('livewire')->mount($__name, $__params, 'FdFWeBR', $__slots ?? [], get_defined_vars());

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
[$__name, $__params] = $__split('widgets.monthly-focus', ['year' => '2022']);

$__html = app('livewire')->mount($__name, $__params, 'UPi2Hsd', $__slots ?? [], get_defined_vars());

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
[$__name, $__params] = $__split('widgets.monthly-focus', ['year' => '2021']);

$__html = app('livewire')->mount($__name, $__params, 'YaWdIvr', $__slots ?? [], get_defined_vars());

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
[$__name, $__params] = $__split('widgets.monthly-focus', ['year' => '2020']);

$__html = app('livewire')->mount($__name, $__params, 'KlCLnH3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4)): ?>
<?php $component = $__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4; ?>
<?php unset($__componentOriginal76c49155e48b3f7884f6f3f0d0c46be4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.archive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/pages/archives/monthly-magazine.blade.php ENDPATH**/ ?>