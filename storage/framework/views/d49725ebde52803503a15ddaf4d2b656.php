

<?php $__env->startSection('content'); ?>


    <!-- IF ALUMNI IS PENDING VERIFICATION -->
    <?php if(Auth::user()->role === 'alumni' && strtolower(trim(Auth::user()->status)) === 'pending'): ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel text-center" style="padding: 40px 20px;">
                    <i class="fa fa-clock-o text-warning" style="font-size: 60px; margin-bottom: 20px;"></i>
                    <h2 class="font-bold text-gray-800" style="font-size: 24px;">Account Application Pending Review</h2>
                    <p class="text-muted" style="max-width: 600px; margin: 15px auto; font-size: 14px;">
                        Hello, <strong><?php echo e(Auth::user()->name); ?></strong>! Thank you for registering on the platform. Your profile is currently under verification by the institution's Admin board. You will gain full access once your alumni credentials match our archives.
                    </p>

                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline-block; margin-top: 15px;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-sign-out"></i> Log Out Safely
                    </button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- top tiles --> 
        <div class="row tile_count"> 
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
                <span class="count_top"><i class="fa fa-user"></i> Total Users</span> 
                <div class="count"><?php echo e($totalUsers ?? '0'); ?></div> 
                <span class="count_bottom"><i class="green">Active </i> accounts</span> 
            </div> 

            <!-- Admin Stat: Pending Approvals -->
            <?php if(Auth::user()->role === 'admin'): ?>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
                <span class="count_top"><i class="fa fa-clock-o"></i> Pending Alumni</span> 
                <div class="count text-danger"><?php echo e($pending_alumni_count ?? '0'); ?></div> 
                <span class="count_bottom"><i class="red">Awaiting </i> verification</span> 
            </div> 
            <?php endif; ?>

            <!-- Account Officer / Admin Stat: Total Cash Collections -->
            <?php if(in_array(Auth::user()->role, ['admin', 'account_officer'])): ?>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
                <span class="count_top"><i class="fa fa-money"></i> Total Collections</span> 
                <div class="count green">
                    <?php if(isset($allInvoices)): ?>
                        ৳<?php echo e(number_format($allInvoices->where('status', 'paid')->sum('amount'), 0)); ?>

                    <?php else: ?>
                        ৳0
                    <?php endif; ?>
                </div> 
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Paid invoices</span> 
            </div> 

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
                <span class="count_top"><i class="fa fa-calculator"></i> Pending Dues</span> 
                <div class="count text-warning">
                    <?php if(isset($allInvoices)): ?>
                        ৳<?php echo e(number_format($allInvoices->where('status', 'unpaid')->sum('amount'), 0)); ?>

                    <?php else: ?>
                        ৳0
                    <?php endif; ?>
                </div> 
                <span class="count_bottom"><i class="orange">Unpaid </i> bills</span> 
            </div> 
            <?php endif; ?>

            <?php if(Auth::user()->role === 'alumni'): ?>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
                <span class="count_top"><i class="fa fa-credit-card"></i> My Pending Fees</span> 
                <div class="count text-danger">
                    ৳<?php echo e(number_format($myInvoices->where('status', 'unpaid')->sum('amount'), 0)); ?>

                </div> 
                <span class="count_bottom"><i class="red">Due </i> immediately</span> 
            </div> 
            <?php endif; ?>

            <!--Total Upcoming Events -->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
                <span class="count_top"><i class="fa fa-calendar"></i> Total Events</span> 
                <div class="count">
                    <?php if(Auth::user()->role === 'alumni'): ?>
                        <?php echo e($upcoming_events->count()); ?>

                    <?php else: ?>
                        <?php echo e($allEvents->count()); ?>

                    <?php endif; ?>
                </div> 
                <span class="count_bottom"><i class="green">Scheduled </i> events</span> 
            </div> 
        </div> 
        <!-- /top tiles --> 

        <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12"> 
                <div class="dashboard_graph"> 
                    <div class="row x_title"> 
                        <div class="col-md-6"> 
                            <h3>Alumni Engagement <small>Platform Interaction Tracking</small></h3> 
                        </div> 
                        <div class="col-md-6"> 
                            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc"> 
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> 
                                <span><?php echo e(now()->startOfMonth()->format('F d, Y')); ?> - <?php echo e(now()->format('F d, Y')); ?></span> 
                                <b class="caret"></b> 
                            </div> 
                        </div> 
                    </div> 

                    <div class="col-md-9 col-sm-9 col-xs-12"> 
                        <div id="chart_plot_01" class="demo-placeholder"></div> 
                    </div> 

                    <div class="col-md-3 col-sm-3 col-xs-12 bg-white"> 
                        <div class="x_title"> 
                            <h2>Alumni Batch Distribution</h2> 
                            <div class="clearfix"></div> 
                        </div> 
                        
                        <div class="col-md-12 col-sm-12 col-xs-6"> 
                            <div> 
                                <p>CSE Alumni Batch</p> 
                                <div class="progress progress_sm" style="width: 100%;"> 
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="65"></div> 
                                </div> 
                            </div> 
                            <div> 
                                <p>BBA Alumni Batch</p> 
                                <div class="progress progress_sm" style="width: 100%;"> 
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="45"></div> 
                                </div> 
                            </div> 
                        </div> 
                        
                        <div class="col-md-12 col-sm-12 col-xs-6"> 
                            <div> 
                                <p>EEE Alumni Batch</p> 
                                <div class="progress progress_sm" style="width: 100%;"> 
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 

                    <div class="clearfix"></div> 
                </div> 
            </div> 
        </div> 
        <br /> 

        <div class="row"> 
            <!-- Department Share (Now centered/expanded as left component) -->
            <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="x_panel tile fixed_height_320 overflow_hidden"> 
                    <div class="x_title"> 
                        <h2>Department Share</h2> 
                        <ul class="nav navbar-right panel_toolbox"> 
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            <li><a class="close-link"><i class="fa fa-close"></i></a> </li> 
                        </ul> 
                        <div class="clearfix"></div> 
                    </div> 
                    <div class="x_content"> 
                        <table style="width:100%"> 
                            <tr> 
                                <th style="width:37%;"> 
                                    <p>Overview</p> 
                                </th> 
                                <th> 
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"> <p>Department</p> </div> 
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"> <p>Ratio</p> </div> 
                                </th> 
                            </tr> 
                            <tr> 
                                <td> 
                                    <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas> 
                                </td> 
                                <td> 
                                    <table class="tile_info"> 
                                        <tr> 
                                            <td> <p><i class="fa fa-square blue"></i>CSE </p> </td> 
                                            <td>45%</td> 
                                        </tr> 
                                        <tr> 
                                            <td> <p><i class="fa fa-square green"></i>EEE </p> </td> 
                                            <td>25%</td> 
                                        </tr> 
                                        <tr> 
                                            <td> <p><i class="fa fa-square purple"></i>BBA </p> </td> 
                                            <td>20%</td> 
                                        </tr> 
                                        <tr> 
                                            <td> <p><i class="fa fa-square red"></i>Civil </p> </td> 
                                            <td>10%</td> 
                                        </tr> 
                                    </table> 
                                </td> 
                            </tr> 
                        </table> 
                    </div> 
                </div> 
            </div>
          
            <!-- Quick Actions -->
            <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="x_panel tile fixed_height_320"> 
                    <div class="x_title"> 
                        <h2>Quick Actions</h2> 
                        <ul class="nav navbar-right panel_toolbox"> 
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            <li><a class="close-link"><i class="fa fa-close"></i></a> </li> 
                        </ul> 
                        <div class="clearfix"></div> 
                    </div> 
                    
                    <div class="x_content"> 
                        <div class="dashboard-widget-content"> 
                            <ul class="quick-list"> 
                                <?php if(Auth::user()->role === 'admin'): ?>
                                    <li><i class="fa fa-users"></i><a href="#">Verify Accounts</a> </li> 
                                    <li><i class="fa fa-bullhorn"></i><a href="#">Post Announcement</a> </li> 
                                    <li><i class="fa fa-calendar"></i><a href="#">Manage Events</a> </li>
                                    <li><i class="fa fa-cogs"></i><a href="#">System Health</a> </li>
                                <?php elseif(Auth::user()->role === 'account_officer'): ?>
                                    <li><i class="fa fa-plus-circle"></i><a href="#">Issue New Invoice</a> </li> 
                                    <li><i class="fa fa-check-square-o"></i><a href="#">Verify Payments</a> </li> 
                                    <li><i class="fa fa-file-text-o"></i><a href="#">Financial Reports</a> </li>
                                    <li><i class="fa fa-envelope-o"></i><a href="#">Send Due Alerts</a> </li>
                                <?php elseif(Auth::user()->role === 'alumni'): ?>
                                    <li><i class="fa fa-user"></i><a href="#">Edit My Profile</a> </li> 
                                    <li><i class="fa fa-credit-card"></i><a href="#">Pay Outstanding Dues</a> </li> 
                                    <li><i class="fa fa-calendar-check-o"></i><a href="#">Event Invitations</a> </li> 
                                    <li><i class="fa fa-briefcase"></i><a href="#">Job Board</a> </li>
                                <?php endif; ?>
                            </ul> 

                            <div class="sidebar-widget"> 
                                <h4>
                                    <?php if(Auth::user()->role === 'alumni'): ?>
                                        My Profile Fill Rate
                                    <?php else: ?>
                                        Overall Registry Health
                                    <?php endif; ?>
                                </h4> 
                                <canvas width="150" height="80" id="chart_gauge_01" style="width: 160px; height: 100px;"></canvas> 
                                <div class="goal-wrapper"> 
                                    <span id="gauge-text" class="gauge-value pull-left">
                                        <?php echo e(Auth::user()->role === 'alumni' ? '85' : '94'); ?>

                                    </span> 
                                    <span class="gauge-value pull-left">%</span> 
                                    <span id="goal-text" class="goal-value pull-right">100%</span> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 

        <div class="row"> 
            <!-- Upcoming Events / Logs (Stretched to 6-span layout for a balanced look) -->
            <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="x_panel"> 
                    <div class="x_title"> 
                        <h2>
                            <?php if(Auth::user()->role === 'alumni'): ?>
                                Upcoming Events
                            <?php else: ?>
                                System Activities Log
                            <?php endif; ?>
                        </h2> 
                        <ul class="nav navbar-right panel_toolbox"> 
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            <li><a class="close-link"><i class="fa fa-close"></i></a> </li> 
                        </ul> 
                        <div class="clearfix"></div> 
                    </div> 
                    <div class="x_content"> 
                        <div class="dashboard-widget-content"> 
                            <ul class="list-unstyled timeline widget"> 
                                <?php if(Auth::user()->role === 'alumni'): ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $upcoming_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li> 
                                        <div class="block"> 
                                            <div class="block_content"> 
                                                <h2 class="title"> <a><?php echo e($event->title); ?></a> </h2> 
                                                <div class="byline"> 
                                                    <span>Date: <?php echo e($event->event_date); ?></span>
                                                </div> 
                                                <p class="excerpt">
                                                    Join our upcoming campus gathering! Click below to view event details and secure your seat.
                                                    <a href="#" class="text-info">RSVP Now</a>
                                                </p> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-muted p-3">No upcoming events found.</p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <li> 
                                        <div class="block"> 
                                            <div class="block_content"> 
                                                <h2 class="title"> <a>Alumni Registry Checked</a> </h2> 
                                                <div class="byline"> <span>2 hours ago</span> by <a>System Engine</a> </div> 
                                                <p class="excerpt">Verified background information profiles and automated sync for graduating batch accounts.</p> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li> 
                                        <div class="block"> 
                                            <div class="block_content"> 
                                                <h2 class="title"> <a>Invoice Generation Cron Job</a> </h2> 
                                                <div class="byline"> <span>5 hours ago</span> by <a>Account Trigger</a> </div> 
                                                <p class="excerpt">Monthly system subscription and annual registration dues invoices generated for pending profiles.</p> 
                                            </div> 
                                        </div> 
                                    </li> 
                                <?php endif; ?>
                            </ul> 
                        </div> 
                    </div> 
                </div> 
            </div> 

            <!-- Notice Board / Weather Widget (Stretched to 6-span layout to stand parallel to events) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel"> 
                    <div class="x_title"> 
                        <h2>
                            <?php if(Auth::user()->role === 'alumni'): ?>
                                Campus Notice Board
                            <?php elseif(Auth::user()->role === 'account_officer'): ?>
                                Latest Payment Claims
                            <?php else: ?>
                                Admin Bulletin Controls
                            <?php endif; ?>
                        </h2> 
                        <ul class="nav navbar-right panel_toolbox"> 
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            <li><a class="close-link"><i class="fa fa-close"></i></a> </li> 
                        </ul> 
                        <div class="clearfix"></div> 
                    </div> 
                    
                    <div class="x_content"> 
                        <div class="row"> 
                            <div class="col-sm-12"> 
                                <div class="temperature">
                                    <b>System Update</b>: <?php echo e(now()->format('l, h:i A')); ?> 
                                    <span>(Local Time)</span>
                                </div> 
                            </div> 
                        </div> 

                        <div class="row" style="margin-top: 15px; margin-bottom: 15px;"> 
                            <div class="col-sm-2"> 
                                <div class="weather-icon"> 
                                    <i class="fa fa-bullhorn text-success" style="font-size: 45px; padding-left: 10px;"></i>
                                </div> 
                            </div> 
                            <div class="col-sm-10"> 
                                <div class="weather-text"> 
                                    <?php if(Auth::user()->role === 'alumni'): ?>
                                        <h2>Convocation Registration Notice<br><small>Deadlines for fee submissions approach soon.</small></h2> 
                                    <?php elseif(Auth::user()->role === 'account_officer'): ?>
                                        <h2>Bank Gateway Online<br><small>Automated bkash/Nagad logs active.</small></h2>
                                    <?php else: ?>
                                        <h2>Global Admin Active Desk<br><small>All platform endpoints monitoring clear.</small></h2>
                                    <?php endif; ?>
                                </div> 
                            </div> 
                        </div> 

                        <div class="clearfix"></div> 

                        <div class="row weather-days" style="border-top: 1px solid #eee; padding-top: 15px;"> 
                            <div class="col-sm-4 text-center"> 
                                <div class="daily-weather"> 
                                    <h2 class="day" style="font-size: 11px; font-weight: bold; color: #73879C;">Total Events</h2> 
                                    <h3 class="degrees" style="font-size: 16px; margin: 5px 0;">
                                        <?php echo e(Auth::user()->role === 'alumni' ? ($upcoming_events->count() ?? 0) : ($allEvents->count() ?? 0)); ?>

                                    </h3> 
                                    <h5>Active</h5> 
                                </div> 
                            </div> 

                            <div class="col-sm-4 text-center"> 
                                <div class="daily-weather"> 
                                    <h2 class="day" style="font-size: 11px; font-weight: bold; color: #73879C;">Invoices</h2> 
                                    <h3 class="degrees" style="font-size: 16px; margin: 5px 0; color: #26B99A;">
                                        <?php if(Auth::user()->role === 'alumni'): ?>
                                            <?php echo e($myInvoices->where('status', 'paid')->count()); ?>

                                        <?php else: ?>
                                            <?php echo e($allInvoices->where('status', 'paid')->count()); ?>

                                        <?php endif; ?>
                                    </h3> 
                                    <h5>Paid Items</h5> 
                                </div> 
                            </div> 

                            <div class="col-sm-4 text-center"> 
                                <div class="daily-weather"> 
                                    <h2 class="day" style="font-size: 11px; font-weight: bold; color: #73879C;">Pending</h2> 
                                    <h3 class="degrees" style="font-size: 16px; margin: 5px 0; color: #E74C3C;">
                                        <?php if(Auth::user()->role === 'alumni'): ?>
                                            <?php echo e($myInvoices->where('status', 'unpaid')->count()); ?>

                                        <?php else: ?>
                                            <?php echo e(Auth::user()->role === 'admin' ? ($pending_alumni_count ?? 0) : ($allInvoices->where('status', 'unpaid')->count() ?? 0)); ?>

                                        <?php endif; ?>
                                    </h3> 
                                    <h5>Action Req.</h5> 
                                </div> 
                            </div> 
                            <div class="clearfix"></div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
    <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views/panel/pages/dashboard.blade.php ENDPATH**/ ?>