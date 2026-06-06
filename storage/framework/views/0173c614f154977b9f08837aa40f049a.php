

<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('admin.events.update', $events->id)); ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?> <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Event Name <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="name" name="name" value="<?php echo e(old('name', $events->name)); ?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Event Category</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="category_name" name="category_name" 
                value="<?php echo e(old('category_name', $events->category->name ?? '')); ?>" 
                list="category_list" class="form-control col-md-7 col-xs-12" 
                placeholder="Type to search or enter a new category">
            
            <datalist id="category_list">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->name); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </datalist>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="place">Venue / Place <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="place" name="place" value="<?php echo e(old('place', $events->place)); ?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organized_by">Organized By <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="organized_by" name="organized_by" value="<?php echo e(old('organized_by', $events->organized_by)); ?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">Event Date & Time</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="datetime-local" id="event_date" name="event_date" 
                   value="<?php echo e($events->event_date ? \Illuminate\Support\Carbon::parse($events->event_date)->format('Y-m-d\TH:i') : ''); ?>" 
                   class="form-control col-md-7 col-xs-12">
        </div>
    </div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">
        Registration Fee (TK) <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="input-group" style="margin-bottom: 0;">
            <span class="input-group-addon" style="background: #F2F5F7; font-weight: bold;">TK</span>
            <input type="number" id="amount" name="amount" step="0.01" min="0" 
                   value="<?php echo e(isset($event) ? $event->amount : old('amount', '0.00')); ?>" 
                   class="form-control col-md-7 col-xs-12" required>
        </div>
        <small class="text-muted">Set to 0.00 if this is a free event.</small>
    </div>
</div>

    <div class="ln_solid"></div>
    
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a href="<?php echo e(route('admin.events.index')); ?>" class="btn btn-primary">Cancel</a>
            <button type="submit" class="btn btn-success">Update</button> </div>
    </div>

</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('panel.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views\admin\events\edit.blade.php ENDPATH**/ ?>