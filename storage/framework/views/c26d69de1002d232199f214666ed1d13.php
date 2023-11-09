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
        $debounce = $getLiveDebounce();
        $isAddable = $isAddable();
        $isDeletable = $isDeletable();
        $isDisabled = $isDisabled();
        $isReorderable = $isReorderable();
        $statePath = $getStatePath();
    ?>

    <div
        <?php echo e($attributes
                ->merge($getExtraAttributes(), escape: false)
                ->class([
                    'fi-fo-key-value rounded-lg shadow-sm ring-1 transition duration-75 focus-within:ring-2',
                    'bg-white dark:bg-white/5' => ! $isDisabled,
                    'bg-gray-50 dark:bg-transparent' => $isDisabled,
                    'ring-gray-950/10 focus-within:ring-primary-600 dark:focus-within:ring-primary-500' => ! $errors->has($statePath),
                    'dark:ring-white/20' => (! $errors->has($statePath)) && (! $isDisabled),
                    'dark:ring-white/10' => (! $errors->has($statePath)) && $isDisabled,
                    'ring-danger-600 focus-within:ring-danger-600 dark:ring-danger-500 dark:focus-within:ring-danger-500' => $errors->has($statePath),
                ])); ?>

    >
        <div
            ax-load
            ax-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('key-value', 'filament/forms')); ?>"
            wire:ignore
            x-data="keyValueFormComponent({
                        state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$statePath}')")); ?>,
                    })"
            x-ignore
            <?php echo e($attributes
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->class(['divide-y divide-gray-200 dark:divide-white/10'])); ?>

        >
            <table
                class="w-full table-auto divide-y divide-gray-200 dark:divide-white/5"
            >
                <thead>
                    <tr>
                        <!--[if BLOCK]><![endif]--><?php if($isReorderable && (! $isDisabled)): ?>
                            <th
                                scope="col"
                                x-show="rows.length"
                                class="w-9"
                            ></th>
                        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

                        <th
                            scope="col"
                            class="px-3 py-2 text-start text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            <?php echo e($getKeyLabel()); ?>

                        </th>

                        <th
                            scope="col"
                            class="px-3 py-2 text-start text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            <?php echo e($getValueLabel()); ?>

                        </th>

                        <!--[if BLOCK]><![endif]--><?php if($isDeletable && (! $isDisabled)): ?>
                            <th
                                scope="col"
                                x-show="rows.length"
                                class="w-9"
                            ></th>
                        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                    </tr>
                </thead>

                <tbody
                    <?php if($isReorderable): ?>
                        x-on:end="reorderRows($event)"
                        x-sortable
                    <?php endif; ?>
                    class="divide-y divide-gray-200 dark:divide-white/5"
                >
                    <template
                        x-bind:key="index"
                        x-for="(row, index) in rows"
                    >
                        <tr
                            <?php if($isReorderable): ?>
                                x-bind:x-sortable-item="row.key"
                            <?php endif; ?>
                            class="divide-x divide-gray-200 rtl:divide-x-reverse dark:divide-white/5"
                        >
                            <!--[if BLOCK]><![endif]--><?php if($isReorderable && (! $isDisabled)): ?>
                                <td class="p-0.5">
                                    <div x-sortable-handle class="flex">
                                        <?php echo e($getAction('reorder')); ?>

                                    </div>
                                </td>
                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

                            <td class="w-1/2 p-0">
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.index','data' => ['disabled' => (! $canEditKeys()) || $isDisabled,'placeholder' => filled($placeholder = $getKeyPlaceholder()) ? $placeholder : null,'type' => 'text','xModel' => 'row.key','attributes' => 
                                        \Filament\Support\prepare_inherited_attributes(
                                            new \Illuminate\View\ComponentAttributeBag([
                                                'x-on:input.debounce.' . ($debounce ?? '500ms') => 'updateState',
                                            ])
                                        )
                                    ,'class' => 'font-mono']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((! $canEditKeys()) || $isDisabled),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($placeholder = $getKeyPlaceholder()) ? $placeholder : null),'type' => 'text','x-model' => 'row.key','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                                        \Filament\Support\prepare_inherited_attributes(
                                            new \Illuminate\View\ComponentAttributeBag([
                                                'x-on:input.debounce.' . ($debounce ?? '500ms') => 'updateState',
                                            ])
                                        )
                                    ),'class' => 'font-mono']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </td>

                            <td class="w-1/2 p-0">
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.index','data' => ['disabled' => (! $canEditValues()) || $isDisabled,'placeholder' => filled($placeholder = $getValuePlaceholder()) ? $placeholder : null,'type' => 'text','xModel' => 'row.value','attributes' => 
                                        \Filament\Support\prepare_inherited_attributes(
                                            new \Illuminate\View\ComponentAttributeBag([
                                                'x-on:input.debounce.' . ($debounce ?? '500ms') => 'updateState',
                                            ])
                                        )
                                    ,'class' => 'font-mono']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((! $canEditValues()) || $isDisabled),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($placeholder = $getValuePlaceholder()) ? $placeholder : null),'type' => 'text','x-model' => 'row.value','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                                        \Filament\Support\prepare_inherited_attributes(
                                            new \Illuminate\View\ComponentAttributeBag([
                                                'x-on:input.debounce.' . ($debounce ?? '500ms') => 'updateState',
                                            ])
                                        )
                                    ),'class' => 'font-mono']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </td>

                            <!--[if BLOCK]><![endif]--><?php if($isDeletable && (! $isDisabled)): ?>
                                <td class="p-0.5">
                                    <div x-on:click="deleteRow(index)">
                                        <?php echo e($getAction('delete')); ?>

                                    </div>
                                </td>
                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                        </tr>
                    </template>
                </tbody>
            </table>

            <!--[if BLOCK]><![endif]--><?php if($isAddable && (! $isDisabled)): ?>
                <div class="flex justify-center px-3 py-2">
                    <span x-on:click="addRow" class="flex">
                        <?php echo e($getAction('add')); ?>

                    </span>
                </div>
            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH /home/yash/vision-ca-api/vendor/filament/forms/src/../resources/views/components/key-value.blade.php ENDPATH**/ ?>