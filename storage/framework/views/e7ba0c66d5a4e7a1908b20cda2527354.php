<div class="flex h-20 items-center justify-between">
    <div class="w-3/4">
        <ul class="flex">
            <li class="font-semibold pr-6">
                <a href="<?php echo e(route('home')); ?>" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 21.0002H5C4.44772 21.0002 4 20.5525 4 20.0002V11.0002H1L11.3273 1.61174C11.7087 1.265 12.2913 1.265 12.6727 1.61174L23 11.0002H20V20.0002C20 20.5525 19.5523 21.0002 19 21.0002ZM13 19.0002H18V9.15769L12 3.70314L6 9.15769V19.0002H11V13.0002H13V19.0002Z" fill="#005FAF"/>
                    </svg>
                </a>
            </li>
            <div class="flex" x-data="{ isNewsOpen: false, isMagazineOpen: false, isWeeklyFocusOpen: false }">
                <?php $__currentLoopData = $initiatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $initiative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($initiative->path === '/news-today'): ?>
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @mouseenter="isNewsOpen = true;
                                             isMagazineOpen = false;
                                             isWeeklyFocusOpen = false;
                                             "
                                @mouseleaves="isNewsOpen = false"
                            >
                                <a class="hover:text-visionRed <?php echo e(request()->is('news-today*') ? 'text-visionRed' : ''); ?>" href="<?php echo e($initiative->path); ?>" wire:navigate><?php echo e($initiative->name); ?></a>
                            </li>

                            <?php if (isset($component)) { $__componentOriginale81a7346792243f4a28bdb01e4c54825 = $component; } ?>
<?php $component = App\View\Components\Navigation\Dropdown::resolve(['buttonText' => 'Today\'s News','buttonLink' => ''.e($initiative->path).'','archiveLink' => ''.e(route('news-today.archive')).'','menuData' => $menuData['newsToday']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\Dropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isNewsOpen','@click.away' => 'isNewsOpen = false']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale81a7346792243f4a28bdb01e4c54825)): ?>
<?php $component = $__componentOriginale81a7346792243f4a28bdb01e4c54825; ?>
<?php unset($__componentOriginale81a7346792243f4a28bdb01e4c54825); ?>
<?php endif; ?>
                        </div>
                    <?php elseif($initiative->path === '/monthly-magazine'): ?>
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @mouseenter="isMagazineOpen = true;
                                             isNewsOpen = false;
                                             isWeeklyFocusOpen = false;
                                             "
                                @mouseleaves="isMagazineOpen = false"
                            >
                                <a class="hover:text-visionRed <?php echo e(request()->is('monthly-magazine*') ? 'text-visionRed' : ''); ?>" href="<?php echo e($initiative->path); ?>" wire:navigate><?php echo e($initiative->name); ?></a>
                            </li>

                            <?php if (isset($component)) { $__componentOriginale81a7346792243f4a28bdb01e4c54825 = $component; } ?>
<?php $component = App\View\Components\Navigation\Dropdown::resolve(['buttonText' => 'This Month\'s Magazine','buttonLink' => ''.e($initiative->path).'','archiveLink' => ''.e(route('monthly-magazine.archive')).'','menuData' => $menuData['monthlyMagazine']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\Dropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isMagazineOpen','@click.away' => 'isMagazineOpen = false']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale81a7346792243f4a28bdb01e4c54825)): ?>
<?php $component = $__componentOriginale81a7346792243f4a28bdb01e4c54825; ?>
<?php unset($__componentOriginale81a7346792243f4a28bdb01e4c54825); ?>
<?php endif; ?>
                        </div>
                    <?php elseif($initiative->path === '/weekly-focus'): ?>
                        <div class="relative">
                            <li class="font-semibold pr-6"
                                @mouseenter="isWeeklyFocusOpen = true;
                                             isMagazineOpen = false;
                                             isNewsOpen = false;
                                             "
                                @mouseleaves="isWeeklyFocusOpen = false"
                            >
                                <a class="hover:text-visionRed <?php echo e(request()->is('weekly-focus*') ? 'text-visionRed' : ''); ?>" href="<?php echo e($initiative->path); ?>" wire:navigate><?php echo e($initiative->name); ?></a>
                            </li>

                            <?php if (isset($component)) { $__componentOriginale81a7346792243f4a28bdb01e4c54825 = $component; } ?>
<?php $component = App\View\Components\Navigation\Dropdown::resolve(['buttonText' => 'Latest Edition','buttonLink' => ''.e($initiative->path).'','archiveLink' => ''.e(route('weekly-focus.archive')).'','menuData' => $menuData['weeklyFocus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\Dropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isWeeklyFocusOpen','@click.away' => 'isWeeklyFocusOpen = false']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale81a7346792243f4a28bdb01e4c54825)): ?>
<?php $component = $__componentOriginale81a7346792243f4a28bdb01e4c54825; ?>
<?php unset($__componentOriginale81a7346792243f4a28bdb01e4c54825); ?>
<?php endif; ?>
                        </div>
                    <?php else: ?>
                        <li class="font-semibold pr-6">
                            <a class="hover:text-visionRed <?php echo e(request()->is(trim($initiative->path, '/')) ? 'text-visionRed' : ''); ?>" href="<?php echo e($initiative->path); ?>" wire:navigate><?php echo e($initiative->name); ?></a>
                        </li>
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </ul>
    </div>

    <div class="flex-grow">
        <?php if (isset($component)) { $__componentOriginal5b86e1be5020699d10a743753b4b755d = $component; } ?>
<?php $component = App\View\Components\Widgets\SearchBar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.search-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\SearchBar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b86e1be5020699d10a743753b4b755d)): ?>
<?php $component = $__componentOriginal5b86e1be5020699d10a743753b4b755d; ?>
<?php unset($__componentOriginal5b86e1be5020699d10a743753b4b755d); ?>
<?php endif; ?>
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/navigation/initiatives.blade.php ENDPATH**/ ?>