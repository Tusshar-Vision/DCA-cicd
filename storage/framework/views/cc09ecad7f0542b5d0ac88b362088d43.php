<?php $__env->startSection('title', "Daily News Archive | Current Affairs"); ?>

<?php $__env->startSection('content'); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.daily-news-archive-section', ['year' => '2023']);

$__html = app('livewire')->mount($__name, $__params, 'ZAvbR0B', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.archive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/pages/archives/daily-news.blade.php ENDPATH**/ ?>