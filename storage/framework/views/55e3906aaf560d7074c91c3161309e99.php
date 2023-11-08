<!-- Slider main container -->
<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $featuredArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
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
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
    </div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev swiper-nav-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M4.624 12.4158L15.2226 19.4816C15.4524 19.6348 15.7628 19.5727 15.916 19.3429C15.9708 19.2608 16 19.1643 16 19.0656V4.93408C16 4.65794 15.7761 4.43408 15.5 4.43408C15.4013 4.43408 15.3048 4.4633 15.2226 4.51806L4.624 11.5838C4.3943 11.737 4.3322 12.0474 4.4854 12.2772C4.522 12.3321 4.5691 12.3792 4.624 12.4158Z" fill="white"/>
        </svg>
    </div>
    <div class="swiper-button-next swiper-nav-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M19.376 12.4158L8.77735 19.4816C8.54759 19.6348 8.23715 19.5727 8.08397 19.3429C8.02922 19.2608 8 19.1643 8 19.0656V4.93408C8 4.65794 8.22386 4.43408 8.5 4.43408C8.59871 4.43408 8.69522 4.4633 8.77735 4.51806L19.376 11.5838C19.6057 11.737 19.6678 12.0474 19.5146 12.2772C19.478 12.3321 19.4309 12.3792 19.376 12.4158Z" fill="white"/>
        </svg>
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/components/widgets/highlights-slider.blade.php ENDPATH**/ ?>