<?php $__env->startSection("content"); ?>
    <div class="container" style="max-width: 600px">

        <?php if(session("info")): ?>
            <div class="alert alert-info">
                <?php echo e(session("info")); ?>

            </div>
        <?php endif; ?>
        <?php if(session("success")): ?>
            <div class="alert alert-success">
                <?php echo e(session("success")); ?>

            </div>
        <?php endif; ?>

        
        <?php echo e($articles->links()); ?>


        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h4><?php echo e($article->title); ?></h4>

                    <div class="small text-muted mb-2">
                        
                        <b>
                            <?php echo e($article->user->name); ?>,
                        </b>

                        <b>Category: </b><?php echo e($article->category->name ?? 'Unknown'); ?>, 
                        <b>Comments </b><?php echo e(count($article->comments)); ?>

                    </div>
                    <div>
                        <?php echo e($article->body); ?>

                        <a href="<?php echo e(url("/articles/detail/$article->id")); ?>" class="">
                            more detail &raquo;
                        </a>
                    </div>

                    <div class="small text-success mt-2"><?php echo e($article->created_at->diffForHumans()); ?></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Zin Min Htet\Desktop\laravel\blog\resources\views/articles/index.blade.php ENDPATH**/ ?>