<div class="monthly-focus-single-card">
    <div class="vi-progress-bar-wrapper">
        <?php if (isset($component)) { $__componentOriginalda6e8508251cfbde75378c68b51244d9 = $component; } ?>
<?php $component = App\View\Components\Common\SubHeading::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.sub-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Common\SubHeading::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($year); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda6e8508251cfbde75378c68b51244d9)): ?>
<?php $component = $__componentOriginalda6e8508251cfbde75378c68b51244d9; ?>
<?php unset($__componentOriginalda6e8508251cfbde75378c68b51244d9); ?>
<?php endif; ?>
        <div class="vi-progress-bar-round" data-progress="83"></div>
    </div>
    <div class="monthly-focus-progress-list">
        <div class="monthly-focus-progress-bar">
            <p>January</p>
            <div class="progress-bar">
                <div class="bar" style="width:35%;background-color: #FFE58E;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>February</p>
            <div class="progress-bar">
                <div class="bar" style="width:100%;background-color:#55C786;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>March</p>
            <div class="progress-bar">
                <div class="bar" style="width:35%;background-color: #FFE58E;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>April</p>
            <div class="progress-bar">
                <div class="bar" style="width:100%;background-color:#55C786;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>May</p>
            <div class="progress-bar">
                <div class="bar" style="width:35%;background-color: #FFE58E;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>June</p>
            <div class="progress-bar">
                <div class="bar" style="width:100%;background-color:#55C786;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>July</p>
            <div class="progress-bar">
                <div class="bar" style="width:35%;background-color: #FFE58E;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>August</p>
            <div class="progress-bar">
                <div class="bar" style="width:100%;background-color:#55C786;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>September</p>
            <div class="progress-bar">
                <div class="bar" style="width:35%;background-color: #FFE58E;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>October</p>
            <div class="progress-bar">
                <div class="bar" style="width:100%;background-color:#55C786;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>November</p>
            <div class="progress-bar">
                <div class="bar" style="width:35%;background-color: #FFE58E;">
                </div>
            </div>
        </div>
        <div class="monthly-focus-progress-bar">
            <p>December</p>
            <div class="progress-bar">
                <div class="bar" style="width:100%;background-color:#55C786;">
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/monthly-focus.blade.php ENDPATH**/ ?>