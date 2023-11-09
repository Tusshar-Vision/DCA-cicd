<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions' => [],
    'color' => 'gray',
    'icon' => null,
    'tooltip' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'actions' => [],
    'color' => 'gray',
    'icon' => null,
    'tooltip' => null,
]); ?>
<?php foreach (array_filter(([
    'actions' => [],
    'color' => 'gray',
    'icon' => null,
    'tooltip' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div
    <?php echo e($attributes
            ->class([
                'fi-fo-field-wrp-hint flex items-center gap-x-3 text-sm',
                match ($color) {
                    'gray' => 'fi-color-gray text-gray-500',
                    default => 'fi-color-custom text-custom-600 dark:text-custom-400',
                },
            ])
            ->style([
                \Filament\Support\get_color_css_variables(
                    $color,
                    shades: [400, 500, 600],
                ),
            ])); ?>

>
    <!--[if BLOCK]><![endif]--><?php if(! \Filament\Support\is_slot_empty($slot)): ?>
        <?php echo e($slot); ?>

    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($icon): ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['xData' => '{}','icon' => $icon,'xTooltip' => '{ content: ' . \Illuminate\Support\Js::from($tooltip) . ', theme: $store.theme }','class' => \Illuminate\Support\Arr::toCssClasses([
                'fi-fo-field-wrp-hint-icon h-5 w-5',
                match ($color) {
                    'gray' => 'text-gray-400 dark:text-gray-500',
                    default => 'text-custom-500 dark:text-custom-400',
                },
            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-data' => '{}','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'x-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('{ content: ' . \Illuminate\Support\Js::from($tooltip) . ', theme: $store.theme }'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                'fi-fo-field-wrp-hint-icon h-5 w-5',
                match ($color) {
                    'gray' => 'text-gray-400 dark:text-gray-500',
                    default => 'text-custom-500 dark:text-custom-400',
                },
            ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(count($actions)): ?>
        <div class="fi-fo-field-wrp-hint-action flex items-center gap-3">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($action); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
        </div>
    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /home/yash/vision-ca-api/vendor/filament/forms/src/../resources/views/components/field-wrapper/hint.blade.php ENDPATH**/ ?>