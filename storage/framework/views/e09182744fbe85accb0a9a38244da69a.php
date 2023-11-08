<?php
    $counter = 1;
?>

<div class="flex flex-col rounded bg-visionGray pb-4">
    <div class="my-4 mx-6" x-data="{ expanded: <?php if ((object) ('current_topic') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('current_topic'->value()); ?>')<?php echo e('current_topic'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('current_topic'); ?>')<?php endif; ?> }">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mt-4">
                <button class="flex justify-between items-center w-full" @click="
                    if(expanded === 'topic-<?php echo e($topic); ?>') expanded = false;
                    else expanded = 'topic-<?php echo e($topic); ?>'
                ">
                    <div x-show="expanded === 'topic-<?php echo e($topic); ?>'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                <strong>
                                    <?php echo e($counter . '.'); ?>

                                </strong>
                            </div>
                            <div>
                                <strong>
                                    <?php echo e($topic->name); ?>

                                </strong>
                            </div>
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 11V13H19V11H5Z" fill="#8F93A3"/>
                        </svg>
                    </div>
                    <div x-show="expanded !== 'topic-<?php echo e($topic); ?>'" class="flex justify-between items-center w-full">
                        <div class="flex">
                            <div class="w-6">
                                <?php echo e($counter++ . '.'); ?>

                            </div>
                            <div>
                                <?php echo e($topic->name); ?>

                            </div>
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="#8F93A3"/>
                        </svg>
                    </div>
                </button>

                <div x-show="expanded === 'topic-<?php echo e($topic); ?>'" x-collapse>
                    <ul class="space-y-4">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!--[if BLOCK]><![endif]--><?php if($article->topic === $topic): ?>
                                <li class="text-clip text-sm">
                                    <a href="<?php echo e(\App\Services\ArticleService::getArticleURL($article)); ?>" class="cursor-pointer hover:underline"><?php echo e($article->title); ?></a>
                                </li>
                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                    </ul>
                </div>

                <!--[if BLOCK]><![endif]--><?php if(!$loop->last): ?>
                    <svg class="mt-4" width="296" height="2" viewBox="0 0 296 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2" d="M0 1H296" stroke="#8F93A3"/>
                    </svg>
                <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/widgets/articles-side-bar.blade.php ENDPATH**/ ?>