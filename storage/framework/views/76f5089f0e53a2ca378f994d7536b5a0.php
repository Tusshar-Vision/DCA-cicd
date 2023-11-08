<?php
    use Carbon\Carbon;
?>

<div class="flex h-10 text-white items-center bg-visionBlue space-x-8">
    <p class="text-sm font-bold pl-2"><?php echo e(Carbon::parse($publishedDate)->format('F Y')); ?></p>

    <svg class="bg-white" width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 1H15"/>
    </svg>

    <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a><?php echo e($topic->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /home/yash/vision-ca-api/resources/views/components/navigation/topics.blade.php ENDPATH**/ ?>