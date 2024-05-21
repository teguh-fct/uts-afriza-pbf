

<?php $__env->startSection('body'); ?>
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h5>JWT Token</h5>
                <textarea name="" id="" cols="30" class="form-control" rows="10" readonly><?php echo e($token); ?></textarea>
                <a href="/auth/logout" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.bootstrap', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\UBPK\s4\framework\uts\restful-api\resources\views/dashboard.blade.php ENDPATH**/ ?>