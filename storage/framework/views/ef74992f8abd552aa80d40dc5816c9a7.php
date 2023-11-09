<div class="flex mt-5 pb-4 border-b border-visionLineGray justify-between">
    <div>
        <h1 class="font-normal text-4xl"><?php echo e($title); ?></h1>
    </div>
    <div class="flex items-center space-x-4">
        <p>Filter</p>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.filter', []);

$__html = app('livewire')->mount($__name, $__params, 'Ipkw4fo', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/header/archives.blade.php ENDPATH**/ ?>