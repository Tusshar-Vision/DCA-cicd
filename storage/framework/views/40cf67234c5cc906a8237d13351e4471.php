<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field]); ?>
    <?php
        $id = $getId();
        $isDisabled = $isDisabled();
        $statePath = $getStatePath();
    ?>

    <div
        ax-load
        ax-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('tags-input', 'filament/forms')); ?>"
        x-data="tagsInputFormComponent({
                    state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$statePath}')")); ?>,
                    splitKeys: <?php echo \Illuminate\Support\Js::from($getSplitKeys())->toHtml() ?>,
                })"
        x-ignore
        <?php echo e($attributes
                ->merge($getExtraAttributes(), escape: false)
                ->merge($getExtraAlpineAttributes(), escape: false)
                ->class([
                    'fi-fo-tags-input block w-full rounded-lg shadow-sm ring-1 transition duration-75',
                    'bg-gray-50 dark:bg-transparent' => $isDisabled,
                    'bg-white focus-within:ring-2 dark:bg-white/5' => ! $isDisabled,
                    'ring-danger-600 focus-within:ring-danger-600 dark:ring-danger-500 dark:focus-within:ring-danger-500' => $errors->has($statePath),
                    'ring-gray-950/10 focus-within:ring-primary-600 dark:focus-within:ring-primary-500' => ! $errors->has($statePath),
                    'dark:ring-white/20' => (! $isDisabled) && (! $errors->has($statePath)),
                    'dark:ring-white/10' => $isDisabled && (! $errors->has($statePath)),
                ])); ?>

    >
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.index','data' => ['autocomplete' => 'off','autofocus' => $isAutofocused(),'disabled' => $isDisabled,'id' => $id,'list' => $id . '-suggestions','placeholder' => $getPlaceholder(),'type' => 'text','xBind' => 'input','attributes' => \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['autocomplete' => 'off','autofocus' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isAutofocused()),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id),'list' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id . '-suggestions'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getPlaceholder()),'type' => 'text','x-bind' => 'input','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag()))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

        <datalist id="<?php echo e($id); ?>-suggestions">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $getSuggestions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <template
                    x-bind:key="<?php echo \Illuminate\Support\Js::from($suggestion)->toHtml() ?>"
                    x-if="! state.includes(<?php echo \Illuminate\Support\Js::from($suggestion)->toHtml() ?>)"
                >
                    <option value="<?php echo e($suggestion); ?>" />
                </template>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
        </datalist>

        <div wire:ignore>
            <template x-cloak x-if="state?.length">
                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'flex w-full flex-wrap gap-1.5 p-2',
                        'border-t border-t-gray-200 dark:border-t-white/10',
                    ]); ?>"
                >
                    <template
                        x-for="tag in state"
                        x-bind:key="tag"
                        class="hidden"
                    >
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo e($getTagPrefix()); ?>


                            <span class="text-start" x-text="tag"></span>

                            <?php echo e($getTagSuffix()); ?>


                            <!--[if BLOCK]><![endif]--><?php if(! $isDisabled): ?>
                                 <?php $__env->slot('deleteButton', null, ['x-on:click' => 'deleteTag(tag)']); ?>  <?php $__env->endSlot(); ?>
                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </template>
                </div>
            </template>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH /home/yash/vision-ca-api/vendor/filament/forms/src/../resources/views/components/tags-input.blade.php ENDPATH**/ ?>