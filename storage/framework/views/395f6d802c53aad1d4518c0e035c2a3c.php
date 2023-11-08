<div class="flex gap-10 mt-6" wire:poll.240s="getData">
    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $latestNewsArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginald5f9052de6d9363a8e1eae3cc7d5facb = $component; } ?>
<?php $component = App\View\Components\Cards\Article::resolve(['article' => $article,'type' => 'large'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.article'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Cards\Article::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5f9052de6d9363a8e1eae3cc7d5facb)): ?>
<?php $component = $__componentOriginald5f9052de6d9363a8e1eae3cc7d5facb; ?>
<?php unset($__componentOriginald5f9052de6d9363a8e1eae3cc7d5facb); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/news-section.blade.php ENDPATH**/ ?>