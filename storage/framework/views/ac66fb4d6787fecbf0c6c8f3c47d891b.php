

<?php $__env->startSection('content'); ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Events <small>List of registered events</small></h2>
                    <div class="nav navbar-right font-panel-options">
                        <a href="/admin/events/create" class="btn btn-primary btn-sm" style="color:#FFF;">+ Create New Event</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">ID</th>
                                <th class="column-title">Event Name</th>
                                <th class="column-title">Category</th>
                                <th class="column-title">Place</th>
                                <th class="column-title">Organized By</th>
                                <th class="column-title">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(count($events) > 0): ?>
                                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="even pointer">
                                        <td><?php echo e($event->id); ?></td>
                                        <td><strong><?php echo e($event->name); ?></strong></td>
                                        <td>
                                            <?php if($event->category): ?>
                                                <span class="label label-info"><?php echo e($event->category->name); ?></span>
                                            <?php else: ?>
                                                <span class="label label-default">None</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($event->place); ?></td>
                                        <td><?php echo e($event->organized_by); ?></td>
                                        <td><?php echo e($event->event_date); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center" style="color: gray; padding: 20px;">
                                        No events found in the database.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views\admin\events\index.blade.php ENDPATH**/ ?>