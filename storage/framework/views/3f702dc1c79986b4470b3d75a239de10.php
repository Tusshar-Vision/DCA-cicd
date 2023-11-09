<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['id','label','labelSrOnly','helperText','hint','hintActions','hintColor','hintIcon','statePath']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['id','label','labelSrOnly','helperText','hint','hintActions','hintColor','hintIcon','statePath']); ?>
<?php foreach (array_filter((['id','label','labelSrOnly','helperText','hint','hintActions','hintColor','hintIcon','statePath']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-forms::components.field-wrapper.index','data' => ['id' => $id,'label' => $label,'labelSrOnly' => $labelSrOnly,'helperText' => $helperText,'hint' => $hint,'hintActions' => $hintActions,'hintColor' => $hintColor,'hintIcon' => $hintIcon,'statePath' => $statePath]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-forms::field-wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'label-sr-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labelSrOnly),'helper-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($helperText),'hint' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hint),'hint-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hintActions),'hint-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hintColor),'hint-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hintIcon),'state-path' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statePath)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?><?php /**PATH /home/yash/vision-ca-api/storage/framework/views/7b2dd0453722fc2b8a98c6e7872448dd.blade.php ENDPATH**/ ?>