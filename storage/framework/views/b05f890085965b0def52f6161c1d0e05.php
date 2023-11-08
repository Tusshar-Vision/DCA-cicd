<div <?php echo e($attributes); ?> x-cloak>
    <ul class="absolute ml-2 font-normal bg-visionGray shadow rounded-sm w-80 border mt-2 py-1 z-20 -top-2 left-full">
        <li class="grid grid-cols-7 gap-1 justify-items-center">
            <?php $__currentLoopData = $getDataToRender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#" class="px-3 py-3 hover:bg-visionSelectedGray">
                    <span class="font-medium"><?php echo e($value); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </li>
    </ul>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/navigation/side-dropdown-calender.blade.php ENDPATH**/ ?>