<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap');
        </style>
        <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
        <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
    </head>
    <body x-data="{ isLoginFormOpen: false, isRegisterFormOpen: false, isResetFormOpen: false }">
        <div class="mx-auto max-w-[90%]">
            <header>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginala9f4b2fdb69dbc4f7d43e6b8c02dcce8 = $component; } ?>
<?php $component = App\View\Components\Navigation\Initiatives::resolve(['initiatives' => $initiatives] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.initiatives'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\Initiatives::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9f4b2fdb69dbc4f7d43e6b8c02dcce8)): ?>
<?php $component = $__componentOriginala9f4b2fdb69dbc4f7d43e6b8c02dcce8; ?>
<?php unset($__componentOriginala9f4b2fdb69dbc4f7d43e6b8c02dcce8); ?>
<?php endif; ?>
                <?php echo $__env->yieldContent('header'); ?>
            </header>

            <main>
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>

        <footer>
            <?php echo $__env->yieldContent('footer'); ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </footer>

        <?php if (isset($component)) { $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33 = $component; } ?>
<?php $component = App\View\Components\Modals\ModalBox::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modals.modal-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modals\ModalBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isLoginFormOpen']); ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.login', []);

$__html = app('livewire')->mount($__name, $__params, 'yVPwDvK', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33)): ?>
<?php $component = $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33; ?>
<?php unset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33 = $component; } ?>
<?php $component = App\View\Components\Modals\ModalBox::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modals.modal-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modals\ModalBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isRegisterFormOpen']); ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.register', []);

$__html = app('livewire')->mount($__name, $__params, 'KGKk1IL', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33)): ?>
<?php $component = $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33; ?>
<?php unset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33 = $component; } ?>
<?php $component = App\View\Components\Modals\ModalBox::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modals.modal-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modals\ModalBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isResetFormOpen']); ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.reset-password', []);

$__html = app('livewire')->mount($__name, $__params, 'v7Ex83d', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33)): ?>
<?php $component = $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33; ?>
<?php unset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33); ?>
<?php endif; ?>
    </body>
</html>
<?php /**PATH /home/yash/vision-ca-api/resources/views/layouts/base.blade.php ENDPATH**/ ?>