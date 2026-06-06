

<?php $__env->startSection('content'); ?>
<div class="" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Error!</strong> <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Success!</strong> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Notice:</strong> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.04); border-radius: 4px; padding: 15px 20px;">
                <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; font-weight: 600; color: #2A3F54; margin: 0;">
                        Available Events <small>Explore invitations and join upcoming programs</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #FFF;">
                                    <th class="column-title" style="padding: 12px 8px; width: 22%;">Event Name</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 13%;">Category</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 18%;">Venue/Place</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Reg Fee</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 15%;">Organized By</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Event Date</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($upcomingEvents) > 0): ?>
                                    <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="vertical-align: middle; padding: 12px 8px; font-weight: 600; color: #333;"><?php echo e($event->name); ?></td>
                                            <td style="vertical-align: middle; padding: 12px 8px;">
                                                <span class="label label-info" style="font-size: 11px; padding: 3px 6px;"><?php echo e($event->category->name ?? 'General'); ?></span>
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;"><i class="fa fa-map-marker" style="color: #E74C3C; margin-right: 5px;"></i> <?php echo e($event->place); ?></td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; font-weight: bold;">
                                                <?php if($event->amount > 0): ?>
                                                    <span style="color: #E74C3C;"><?php echo e(number_format($event->amount, 2)); ?> TK</span>
                                                <?php else: ?>
                                                    <span class="label label-success" style="font-size: 10px; padding: 2px 5px;">FREE</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;"><?php echo e($event->organized_by); ?></td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 11px;">
                                                <?php echo e($event->event_date ? date('d M, Y (h:i A)', strtotime($event->event_date)) : 'TBD'); ?>

                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 8px;">
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#registerModal<?php echo e($event->id); ?>" style="border-radius: 3px; font-weight: 600; background-color: #34495E; border-color: #2C3E50; margin: 0; padding: 5px 10px;">
                                                    <i class="fa fa-plus-circle"></i> Join Event
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="registerModal<?php echo e($event->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content" style="border-radius: 4px;">
                                                    <div class="modal-header" style="background-color: #F2F5F7;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title" style="font-weight: 600; color: #2A3F54; font-size: 15px;">Confirm RSVP</h4>
                                                    </div>
                                                    <form action="<?php echo e(route('alumni.events.register', $event->id)); ?>" method="GET">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-body text-left">
                                                            <p style="font-size: 13px; color: #333; margin-bottom: 5px;">Are you sure you want to register for <strong><?php echo e($event->name); ?></strong>?</p>
                                                            
                                                            <p style="font-size: 13px; color: #333;">
                                                                Registration Fee: 
                                                                <strong>
                                                                    <?php if($event->amount > 0): ?>
                                                                        <span style="color: #E74C3C;"><?php echo e(number_format($event->amount, 2)); ?> TK</span>
                                                                    <?php else: ?>
                                                                        <span style="color: #26B99A;">Free Event</span>
                                                                    <?php endif; ?>
                                                                </strong>
                                                            </p>

                                                            <?php if($event->amount > 0): ?>
                                                                <div class="form-group" style="margin-top: 15px;">
                                                                    <label for="transaction_id" style="font-size: 12px; color: #555; font-weight: 600;">Transaction ID <span style="color: red;">*</span></label>
                                                                    <input type="text" name="transaction_id" class="form-control" placeholder="e.g. bKash / Nagad TrxID" style="border-radius: 3px;" required>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="modal-footer" style="background-color: #F9FAFB;">
                                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 3px;">Cancel</button>
                                                            <button type="submit" class="btn btn-success btn-sm" style="font-weight: 600; border-radius: 3px;">Confirm & Register</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #95a5a6; padding: 30px 20px;">
                                            <i class="fa fa-calendar-minus-o" style="font-size: 24px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                            There are no new upcoming events listed at this time.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right" style="margin-top: 15px;">
                        <?php echo $upcomingEvents->appends(request()->except('upcoming_page'))->links(); ?>

                    </div>
                </div>
            </div>

            <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.04); border-radius: 4px; padding: 15px 20px; margin-top: 25px;">
                <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; font-weight: 600; color: #2A3F54; margin: 0;">
                        My Registered Events <small>Track your joined invitations and status indicators</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #34495E; color: #FFF;">
                                    <th class="column-title" style="padding: 12px 8px; width: 25%;">Event Name</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 13%;">Category</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 17%;">Venue/Place</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 13%;">Amount Paid</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 15%;">Transaction ID</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Event Date</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($participatedEvents) > 0): ?>
                                    <?php $__currentLoopData = $participatedEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pEvent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="vertical-align: middle; padding: 12px 8px; font-weight: 600; color: #333;"><?php echo e($pEvent->name); ?></td>
                                            <td style="vertical-align: middle; padding: 12px 8px;">
                                                <span class="label label-primary" style="font-size: 11px; padding: 3px 6px;"><?php echo e($pEvent->category->name ?? 'General'); ?></span>
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;"><i class="fa fa-map-marker" style="color: #E74C3C; margin-right: 5px;"></i> <?php echo e($pEvent->place); ?></td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; font-weight: bold; color: #333;">
                                                <?php echo e(number_format($pEvent->pivot->amount_paid, 2)); ?> TK
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px;">
                                                <?php if($pEvent->pivot->transaction_id): ?>
                                                    <code><?php echo e($pEvent->pivot->transaction_id); ?></code>
                                                <?php else: ?>
                                                    <span class="text-muted" style="font-size: 11px;">N/A (Free)</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 11px;">
                                                <?php echo e($pEvent->event_date ? date('d M, Y (h:i A)', strtotime($pEvent->event_date)) : 'TBD'); ?>

                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 8px;">
                                                <?php if($pEvent->pivot->payment_status == 'pending'): ?>
                                                    <span class="label label-warning" style="font-size: 11px; padding: 4px 8px; display: inline-block; width: 100px; text-align: center;">
                                                        <i class="fa fa-spinner fa-spin"></i> Pending
                                                    </span>
                                                <?php else: ?>
                                                    <span class="label label-success" style="background-color: #26B99A; font-size: 11px; padding: 4px 8px; display: inline-block; width: 100px; text-align: center;">
                                                        <i class="fa fa-check-circle"></i> Confirmed
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #95a5a6; padding: 30px 20px;">
                                            <i class="fa fa-folder-open-o" style="font-size: 24px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                            You haven't registered for any events yet.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right" style="margin-top: 15px;">
                        <?php echo $participatedEvents->appends(request()->except('participated_page'))->links(); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views\alumni\events\index.blade.php ENDPATH**/ ?>