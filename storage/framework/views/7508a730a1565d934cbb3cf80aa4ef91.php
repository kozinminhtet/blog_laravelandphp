<?php $__env->startSection("content"); ?>
    <div class="container" style="max-width: 600px">

        <?php if(session('info')): ?>
            <div class="alert alert-info">
                <?php echo e(session('info')); ?>

            </div>
        <?php endif; ?>
        
        <div class="card mb-2">
            <div class="card-body">
                <h4><?php echo e($article->title); ?></h4>

                <div class="small text-success mb-2">
                    <b><?php echo e($article->user->name); ?></b>,
                    
                    <b>Category: </b><?php echo e($article->category->name ?? 'Unknown'); ?> 
                </div>

                
                <div class="mb-2">
                    <?php echo e($article->body); ?>

                </div>

                <div class="text-success small">
                    <i>
                    <?php echo e($article->created_at->diffForHumans()); ?>

                    </i>
                </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("delete-article", $article)): ?>
                    <a href="<?php echo e(url("/articles/delete/$article->id")); ?>" class="mt-2 btn btn-outline-danger btn-sm">
                        Delete
                    </a>
                    <a href="<?php echo e(url("/articles/edit/$article->id")); ?>" class="mt-2 btn btn-outline-success btn-sm">
                        Update
                    </a> 
                <?php endif; ?>

            </div>
        </div>

        <ul class="list-group mt-4">
            <li class="list-group-item active">
                Comments (<?php echo e(count($article->comments)); ?>)
            </li>

            <?php $__currentLoopData = $article->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("delete-comment", $comment)): ?>
                        <a href="<?php echo e(url("/comments/delete/$comment->id")); ?>" class="btn-close small float-end"></a>
                    <?php endif; ?>

                    <b class="text-success small"><?php echo e($comment->user->name); ?></b> -
                    <?php echo e($comment->content); ?>

                    <b class="small text-success">
                        <i> <?php echo e($comment->created_at->diffForHumans()); ?></i>
                    </b>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <?php if(auth()->guard()->check()): ?>
            <form action="<?php echo e(url("/comments/add")); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="article_id" value="<?php echo e($article->id); ?>">
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Zin Min Htet\Desktop\laravel\blog\resources\views/articles/detail.blade.php ENDPATH**/ ?>