<div>
    <div class="vi-title-wrap">
        <h5 class="vi-title">Test Yourself</h5>
    </div>

    <?php if (isset($component)) { $__componentOriginala3b14e66c4c3f88d80f4ba55b24f4873 = $component; } ?>
<?php $component = App\View\Components\Cards\QuizBanner::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.quiz-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\QuizBanner::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3b14e66c4c3f88d80f4ba55b24f4873)): ?>
<?php $component = $__componentOriginala3b14e66c4c3f88d80f4ba55b24f4873; ?>
<?php unset($__componentOriginala3b14e66c4c3f88d80f4ba55b24f4873); ?>
<?php endif; ?>

    <div class="grid gap-2 mt-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [1, 2, 3, 4, 5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal41f2a29756e8b59858e9cd366b802312 = $component; } ?>
<?php $component = App\View\Components\Cards\UserScore::resolve(['index' => $user,'score' => rand(100,400)] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.user-score'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\UserScore::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41f2a29756e8b59858e9cd366b802312)): ?>
<?php $component = $__componentOriginal41f2a29756e8b59858e9cd366b802312; ?>
<?php unset($__componentOriginal41f2a29756e8b59858e9cd366b802312); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/leaderboard.blade.php ENDPATH**/ ?>