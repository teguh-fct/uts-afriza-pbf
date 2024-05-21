

<?php $__env->startSection('body'); ?>
    <div class="container">
        <div class="row justify-content-center vh-100 align-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h1 class="text-center">Login</h1>
                    <div class="mt-3">
                        <a href="/auth/google"
                            class="btn btn-outline-<?php echo e(env('APP_COLOR') ?? 'primary'); ?> w-100 text-center">Login with
                            Google</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.bootstrap', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\UBPK\s4\framework\uts\restful-api\resources\views/auth/login.blade.php ENDPATH**/ ?>