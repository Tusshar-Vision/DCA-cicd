<?php $__env->startSection('title', 'Weekly Focus | Current Affairs'); ?>

<?php
    $highlightsHeading = "My Highlights";
    $notesHeading = "My Notes";
?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4">
        <h1 class="text-7xl"><?php echo e($article->title); ?></h1>
        <?php if (isset($component)) { $__componentOriginal962096db5833c72848470a43554fff8c = $component; } ?>
<?php $component = App\View\Components\Widgets\ArticlesNav::resolve(['createdAt' => $article->created_at,'updatedAt' => $article->updated_at] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.articles-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\ArticlesNav::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal962096db5833c72848470a43554fff8c)): ?>
<?php $component = $__componentOriginal962096db5833c72848470a43554fff8c; ?>
<?php unset($__componentOriginal962096db5833c72848470a43554fff8c); ?>
<?php endif; ?>
    </div>

    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        <?php if (isset($component)) { $__componentOriginal1e57b9b784af988d856bb35e0000b081 = $component; } ?>
<?php $component = App\View\Components\Widgets\SideNotesAndHighlightsMenu::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.side-notes-and-highlights-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\SideNotesAndHighlightsMenu::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1e57b9b784af988d856bb35e0000b081)): ?>
<?php $component = $__componentOriginal1e57b9b784af988d856bb35e0000b081; ?>
<?php unset($__componentOriginal1e57b9b784af988d856bb35e0000b081); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33 = $component; } ?>
<?php $component = App\View\Components\Modals\ModalBox::resolve(['heading' => $highlightsHeading] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modals.modal-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modals\ModalBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isHighlightsOpen']); ?>
            <?php if (isset($component)) { $__componentOriginaldc622e78e9ee24ec103116b2f886bac9 = $component; } ?>
<?php $component = App\View\Components\Widgets\ArticleHighlights::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.article-highlights'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\ArticleHighlights::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc622e78e9ee24ec103116b2f886bac9)): ?>
<?php $component = $__componentOriginaldc622e78e9ee24ec103116b2f886bac9; ?>
<?php unset($__componentOriginaldc622e78e9ee24ec103116b2f886bac9); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33)): ?>
<?php $component = $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33; ?>
<?php unset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33 = $component; } ?>
<?php $component = App\View\Components\Modals\ModalBox::resolve(['heading' => $notesHeading] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modals.modal-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Modals\ModalBox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isNotesOpen']); ?>
            <?php if (isset($component)) { $__componentOriginal5b9140056f6c70ab92cba728803c2bf9 = $component; } ?>
<?php $component = App\View\Components\Widgets\ArticleNotes::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.article-notes'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\ArticleNotes::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b9140056f6c70ab92cba728803c2bf9)): ?>
<?php $component = $__componentOriginal5b9140056f6c70ab92cba728803c2bf9; ?>
<?php unset($__componentOriginal5b9140056f6c70ab92cba728803c2bf9); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33)): ?>
<?php $component = $__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33; ?>
<?php unset($__componentOriginalbac5fb1b7ab30698c865dd68b5cf4d33); ?>
<?php endif; ?>
    </div>

    <div class="space-y-12">
        <div class="flex space-x-8">

            <div class="flex w-auto flex-col space-y-6">
                <?php if (isset($component)) { $__componentOriginal8e51d91688b4425039d9e9b8878e3d2a = $component; } ?>
<?php $component = App\View\Components\Widgets\SideBarDownloadMenu::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.side-bar-download-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\SideBarDownloadMenu::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e51d91688b4425039d9e9b8878e3d2a)): ?>
<?php $component = $__componentOriginal8e51d91688b4425039d9e9b8878e3d2a; ?>
<?php unset($__componentOriginal8e51d91688b4425039d9e9b8878e3d2a); ?>
<?php endif; ?>
            </div>

            <div class="flex flex-col w-full">
                <?php if( !empty($articles) && count($articles) !== 0 ): ?>

                    <?php if (isset($component)) { $__componentOriginalc44c09d26a070828a93ff39128d4f0a4 = $component; } ?>
<?php $component = App\View\Components\Header\Article::resolve(['readTime' => ''.e($article->read_time).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header.article'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Header\Article::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc44c09d26a070828a93ff39128d4f0a4)): ?>
<?php $component = $__componentOriginalc44c09d26a070828a93ff39128d4f0a4; ?>
<?php unset($__componentOriginalc44c09d26a070828a93ff39128d4f0a4); ?>
<?php endif; ?>
                    <div class="mt-4 printable-area">
                        <?php echo $article->content; ?>

                    </div>
                    <div class="mt-12">
                        <?php if (isset($component)) { $__componentOriginal4074eae168ee464fb3aa30150f07a4b4 = $component; } ?>
<?php $component = App\View\Components\Widgets\ArticlePagination::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.article-pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\ArticlePagination::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4074eae168ee464fb3aa30150f07a4b4)): ?>
<?php $component = $__componentOriginal4074eae168ee464fb3aa30150f07a4b4; ?>
<?php unset($__componentOriginal4074eae168ee464fb3aa30150f07a4b4); ?>
<?php endif; ?>
                    </div>
                <?php else: ?>
                    <h1>No articles</h1>
                <?php endif; ?>
            </div>

        </div>

        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex flex-col w-5/6 space-y-12">
                <div class="flex space-x-4">
                    <?php if (isset($component)) { $__componentOriginal8a3160d23883f0d22c482f849ba40a24 = $component; } ?>
<?php $component = App\View\Components\Widgets\RelatedTerms::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.related-terms'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\RelatedTerms::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a3160d23883f0d22c482f849ba40a24)): ?>
<?php $component = $__componentOriginal8a3160d23883f0d22c482f849ba40a24; ?>
<?php unset($__componentOriginal8a3160d23883f0d22c482f849ba40a24); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal7cd3923a3c768d34675928532efb25b2 = $component; } ?>
<?php $component = App\View\Components\Widgets\RelatedArticles::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.related-articles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\RelatedArticles::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cd3923a3c768d34675928532efb25b2)): ?>
<?php $component = $__componentOriginal7cd3923a3c768d34675928532efb25b2; ?>
<?php unset($__componentOriginal7cd3923a3c768d34675928532efb25b2); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal7e6260da186e8b5b511415b81a532e63 = $component; } ?>
<?php $component = App\View\Components\Widgets\RelatedVideos::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.related-videos'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\RelatedVideos::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7e6260da186e8b5b511415b81a532e63)): ?>
<?php $component = $__componentOriginal7e6260da186e8b5b511415b81a532e63; ?>
<?php unset($__componentOriginal7e6260da186e8b5b511415b81a532e63); ?>
<?php endif; ?>
                </div>

                <div>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('widgets.comments', []);

$__html = app('livewire')->mount($__name, $__params, 'rDkGeMB', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>

                <div>
                    <?php if (isset($component)) { $__componentOriginalbffa60bea5d03d63a51250c0a2348a3f = $component; } ?>
<?php $component = App\View\Components\Widgets\ArticleSources::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('widgets.article-sources'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Widgets\ArticleSources::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbffa60bea5d03d63a51250c0a2348a3f)): ?>
<?php $component = $__componentOriginalbffa60bea5d03d63a51250c0a2348a3f; ?>
<?php unset($__componentOriginalbffa60bea5d03d63a51250c0a2348a3f); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
        <div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yash/vision-ca-api/resources/views/pages/weekly-focus.blade.php ENDPATH**/ ?>