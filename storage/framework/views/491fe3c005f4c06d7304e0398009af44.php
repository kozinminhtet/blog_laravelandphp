<?php $__env->startSection("content"); ?>

    <div class="container" style="max-width: 600px">
        <h2>New Article</h2>
        
        <?php if($errors->any()): ?>
            <div class="alert alert-warning">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>  
        <?php endif; ?>

        <form action="" method="POST">
            <?php echo csrf_field(); ?>
            <input type="text" name="title" placeholder="Title" class="form-control mb-2">
            <textarea name="body" placeholder="Body" class="form-control mb-2"></textarea>
            <select name="category_id" class="form-select mb-2">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>">
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Zin Min Htet\Desktop\laravel\blog\resources\views/articles/add.blade.php ENDPATH**/ ?>