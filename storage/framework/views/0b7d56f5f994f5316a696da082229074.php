<?php $__env->startSection('title', "Weekly Focus Archive | Current Affairs"); ?>

<?php $__env->startSection('content'); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.weekly-focus-archive-section', ['year' => '2023']);

$__html = app('livewire')->mount($__name, $__params, 'EilvJ4k', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.archive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/pages/archives/weekly-focus.blade.php ENDPATH**/ ?>