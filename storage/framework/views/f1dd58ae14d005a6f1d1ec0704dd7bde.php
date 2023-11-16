<?php if (isset($component)) { $__componentOriginalbe23554f7bded3778895289146189db7 = $component; } ?>
<?php $component = Filament\View\LegacyComponents\Page::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Filament\View\LegacyComponents\Page::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="flex items-center justify-between">
        <div class="w-full mr-2">
            <?php echo e($this->search); ?>

        </div>
        <!--[if BLOCK]><![endif]--><?php if(config('filament-log-manager.allow_delete')): ?>
            <div class="w-auto ml-2">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['xOn:click' => 'window.dispatchEvent(new CustomEvent(\'open-modal\', { detail: { id: \'filament-log-manager-delete-log-file-modal\' } }));','disabled' => is_null($this->logFile),'type' => 'button','color' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-on:click' => 'window.dispatchEvent(new CustomEvent(\'open-modal\', { detail: { id: \'filament-log-manager-delete-log-file-modal\' } }));','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(is_null($this->logFile)),'type' => 'button','color' => 'danger']); ?>
                    <?php echo e(__('filament-log-manager::translations.delete')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
        <!--[if BLOCK]><![endif]--><?php if(config('filament-log-manager.allow_download')): ?>
            <div class="w-auto ml-2">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['wire:click' => 'download','disabled' => is_null($this->logFile),'type' => 'button','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'download','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(is_null($this->logFile)),'type' => 'button','color' => 'primary']); ?>
                    <?php echo e(__('filament-log-manager::translations.download')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
    </div>
    <hr>
    <div>
        <div>
            <div x-data="{ isCardOpen: null }" class="flex flex-col">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $this->getLogs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div
                            class="rounded-xl relative mb-2 py-3 px-3 bg-<?php echo e($log['level_class']); ?>"
                            :class="{'no-bottom-radius mb-0': isCardOpen == <?php echo e($key); ?>}"
                    >
                        <a
                                @click="isCardOpen = isCardOpen == <?php echo e($key); ?> ? null : <?php echo e($key); ?> "
                                style="cursor: pointer;"
                                class="block overflow-hidden rounded-t-xl text-white"
                        >
                            <span>[<?php echo e($log['date']); ?>]</span>
                            <?php echo e(Str::limit($log['text'], 100)); ?>

                        </a>
                    </div>
                    <div x-show="isCardOpen==<?php echo e($key); ?>" class="mb-2 px-4 py-4 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl no-top-radius">
                        <div>
                            <p><?php echo e($log['text']); ?></p>
                            <!--[if BLOCK]><![endif]--><?php if(!empty($log['stack'])): ?>
                                <div class="bg-gray-100 dark:bg-gray-900 mt-4 p-4 text-sm opacity-40">
                                    <pre style="overflow-x: scroll;"><code><?php echo e(trim($log['stack'])); ?></code></pre>
                                </div>
                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <h3 class="text-center"><?php echo e(__('filament-log-manager::translations.no_logs')); ?></h3>
                <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['id' => 'filament-log-manager-delete-log-file-modal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'filament-log-manager-delete-log-file-modal']); ?>
         <?php $__env->slot('heading', null, []); ?> 
            <?php echo e(__('filament-log-manager::translations.modal_delete_heading')); ?>

         <?php $__env->endSlot(); ?>
         <?php $__env->slot('description', null, []); ?> 
            <?php echo e(__('filament-log-manager::translations.modal_delete_subheading')); ?>

         <?php $__env->endSlot(); ?>
         <?php $__env->slot('footerActions', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['type' => 'button','xOn:click' => 'isOpen = false','color' => 'secondary','outlined' => 'true','class' => 'filament-page-modal-button-action']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-on:click' => 'isOpen = false','color' => 'secondary','outlined' => 'true','class' => 'filament-page-modal-button-action']); ?>
                <?php echo e(__('filament-log-manager::translations.modal_delete_action_cancel')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['wire:click' => 'delete','xOn:click' => 'isOpen = false','type' => 'button','color' => 'danger','class' => 'filament-page-modal-button-action']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'delete','x-on:click' => 'isOpen = false','type' => 'button','color' => 'danger','class' => 'filament-page-modal-button-action']); ?>
                <?php echo e(__('filament-log-manager::translations.modal_delete_action_confirm')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe23554f7bded3778895289146189db7)): ?>
<?php $component = $__componentOriginalbe23554f7bded3778895289146189db7; ?>
<?php unset($__componentOriginalbe23554f7bded3778895289146189db7); ?>
<?php endif; ?>
<?php /**PATH /home/yash/vision-ca-api/vendor/filipfonal/filament-log-manager/src/../resources/views/pages/logs.blade.php ENDPATH**/ ?>