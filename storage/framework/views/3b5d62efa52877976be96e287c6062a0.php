<div <?php echo e($attributes); ?> x-cloak>
    <ul class="absolute ml-2 font-normal bg-visionGray shadow rounded-sm w-72 border mt-2 py-1 z-20 -top-2 left-full">
        <?php $__currentLoopData = $getDataToRender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="#" class="flex items-center justify-between px-3 py-3 hover:bg-visionSelectedGray">
                    <span class="ml-2 font-medium"><?php echo e($value); ?></span>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/navigation/side-dropdown.blade.php ENDPATH**/ ?>