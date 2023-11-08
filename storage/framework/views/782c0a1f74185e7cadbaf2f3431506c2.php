<?php
    use Carbon\Carbon;
?>

<div <?php echo e($attributes); ?> x-cloak>
    <ul x-data="{ isMenuOpen: null }" class="absolute font-normal bg-visionGray shadow rounded-sm w-72 border mt-2 py-1 z-50">
        <?php if (isset($component)) { $__componentOriginal71ca0969689f0324d560e7be5ea8cecb = $component; } ?>
<?php $component = App\View\Components\Buttons\Primary::resolve(['buttonText' => ''.$buttonText.'','buttonLink' => ''.e($buttonLink).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Buttons\Primary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71ca0969689f0324d560e7be5ea8cecb)): ?>
<?php $component = $__componentOriginal71ca0969689f0324d560e7be5ea8cecb; ?>
<?php unset($__componentOriginal71ca0969689f0324d560e7be5ea8cecb); ?>
<?php endif; ?>
            <?php $__currentLoopData = $menuData['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainMenu => $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($subMenu)): ?>
                    <li class="relative">
                        <a  href="#"
                            class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray"
                            @mouseenter="isMenuOpen = 'menu<?php echo e($menuData['initiative_id'] . $loop->iteration); ?>'"
                            @click.outside="isMenuOpen = null"
                        >
                            <span class="ml-2 font-medium">
                                <?php echo e(($menuData['initiative_id'] != 2)
                                    ? Carbon::parse($mainMenu)->format('F Y')
                                    : $mainMenu); ?>

                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12.1717 12.0005L9.34326 9.17203L10.7575 7.75781L15.0001 12.0005L10.7575 16.2431L9.34326 14.8289L12.1717 12.0005Z" fill="#8F93A3"/>
                            </svg>
                        </a>

                        <?php if($menuData['initiative_id'] === 1): ?>
                            <?php if (isset($component)) { $__componentOriginal24efff4879da05fe5b95b6725b8e31f6 = $component; } ?>
<?php $component = App\View\Components\Navigation\SideDropdownCalender::resolve(['menuData' => $subMenu,'initiativeId' => $menuData['initiative_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.side-dropdown-calender'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\SideDropdownCalender::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isMenuOpen === \'menu'.e($menuData['initiative_id'] . $loop->iteration).'\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal24efff4879da05fe5b95b6725b8e31f6)): ?>
<?php $component = $__componentOriginal24efff4879da05fe5b95b6725b8e31f6; ?>
<?php unset($__componentOriginal24efff4879da05fe5b95b6725b8e31f6); ?>
<?php endif; ?>
                        <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginalea4253e078c08729de150a220c05c98c = $component; } ?>
<?php $component = App\View\Components\Navigation\SideDropdown::resolve(['menuData' => $subMenu,'initiativeId' => $menuData['initiative_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navigation.side-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Navigation\SideDropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isMenuOpen === \'menu'.e($menuData['initiative_id'] . $loop->iteration).'\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea4253e078c08729de150a220c05c98c)): ?>
<?php $component = $__componentOriginalea4253e078c08729de150a220c05c98c; ?>
<?php unset($__componentOriginalea4253e078c08729de150a220c05c98c); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal71ca0969689f0324d560e7be5ea8cecb = $component; } ?>
<?php $component = App\View\Components\Buttons\Primary::resolve(['buttonText' => 'View All','buttonLink' => ''.e($archiveLink).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Buttons\Primary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71ca0969689f0324d560e7be5ea8cecb)): ?>
<?php $component = $__componentOriginal71ca0969689f0324d560e7be5ea8cecb; ?>
<?php unset($__componentOriginal71ca0969689f0324d560e7be5ea8cecb); ?>
<?php endif; ?>
    </ul>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/navigation/dropdown.blade.php ENDPATH**/ ?>