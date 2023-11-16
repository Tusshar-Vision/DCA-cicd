<?php $__env->startComponent('mail::message'); ?>
# Laravel Health

<?php echo e(__('health::notifications.check_failed_mail_body')); ?>


<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
- <?php echo e($result->check->getLabel()); ?>: <?php echo e($result->getNotificationMessage()); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/yash/vision-ca-api/vendor/spatie/laravel-health/src/../resources/views/mail/checkFailedNotification.blade.php ENDPATH**/ ?>