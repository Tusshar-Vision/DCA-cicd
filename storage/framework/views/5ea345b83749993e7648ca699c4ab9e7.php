<?php
    $canSelectPlaceholder = $canSelectPlaceholder();
    $isDisabled = $isDisabled();

    $state = $getState();
    if ($state instanceof \BackedEnum) {
        $state = $state->value;
    }
    $state = strval($state);
?>

<div
    x-data="{
        error: undefined,

        isLoading: false,

        name: <?php echo \Illuminate\Support\Js::from($getName())->toHtml() ?>,

        recordKey: <?php echo \Illuminate\Support\Js::from($recordKey)->toHtml() ?>,

        state: <?php echo \Illuminate\Support\Js::from($state)->toHtml() ?>,
    }"
    x-init="
        () => {
            Livewire.hook('commit', ({ component, commit, succeed, fail, respond }) => {
                succeed(({ snapshot, effect }) => {
                    $nextTick(() => {
                        if (component.id !== <?php echo \Illuminate\Support\Js::from($this->getId())->toHtml() ?>) {
                            return
                        }

                        if (! $refs.newState) {
                            return
                        }

                        let newState = $refs.newState.value

                        if (state === newState) {
                            return
                        }

                        state = newState
                    })
                })
            })
        }
    "
    <?php echo e($attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-ta-select',
                'px-3 py-4' => ! $isInline(),
            ])); ?>

>
    <input
        type="hidden"
        value="<?php echo e(str($state)->replace('"', '\\"')); ?>"
        x-ref="newState"
    />

    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['alpineDisabled' => 'isLoading || ' . \Illuminate\Support\Js::from($isDisabled),'alpineValid' => 'error === undefined','xTooltip' => '
            error === undefined
                ? false
                : {
                    content: error,
                    theme: $store.theme,
                }
        ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alpine-disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('isLoading || ' . \Illuminate\Support\Js::from($isDisabled)),'alpine-valid' => 'error === undefined','x-tooltip' => '
            error === undefined
                ? false
                : {
                    content: error,
                    theme: $store.theme,
                }
        ']); ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.select','data' => ['disabled' => $isDisabled,'xBind:disabled' => $isDisabled ? null : 'isLoading','xModel' => 'state','xOn:change' => '
                isLoading = true

                const response = await $wire.updateTableColumnState(
                    name,
                    recordKey,
                    $event.target.value,
                )

                error = response?.error ?? undefined

                if (! error) {
                    state = response
                }

                isLoading = false
            ','attributes' => \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled),'x-bind:disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled ? null : 'isLoading'),'x-model' => 'state','x-on:change' => '
                isLoading = true

                const response = await $wire.updateTableColumnState(
                    name,
                    recordKey,
                    $event.target.value,
                )

                error = response?.error ?? undefined

                if (! error) {
                    state = response
                }

                isLoading = false
            ','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag()))]); ?>
            <!--[if BLOCK]><![endif]--><?php if($canSelectPlaceholder): ?>
                <option value=""><?php echo e($getPlaceholder()); ?></option>
            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    <?php if($isOptionDisabled($value, $label)): echo 'disabled'; endif; ?>
                    value="<?php echo e($value); ?>"
                >
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/yash/vision-ca-api/vendor/filament/tables/src/../resources/views/columns/select-column.blade.php ENDPATH**/ ?>