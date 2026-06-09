<nav>
    <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
        <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo e(asset('assets/build/images/image.jpg')); ?>" alt="">
                <?php echo e(Auth::user()->name ?? 'Guest'); ?>

                <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li>
                    <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                    </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                
                <li>
                    <a href="javascript:void(0);" 
                       onclick="event.preventDefault(); document.getElementById('top-logout-form').submit();"
                       style="cursor: pointer;">
                        <i class="fa fa-sign-out pull-right"></i> Log Out
                    </a>

                    <form id="top-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </li>

        <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-green">6</span>
            </a>
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="image"><img src="<?php echo e(asset('assets/panel/images/img.jpg')); ?>" alt="Profile Image" /></span>
                        <span>
                            <?php echo e(Auth::user()->name ?? 'Guest'); ?>

                            <span class=" fa fa-angle-down"></span>
                            <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="image"><img src="<?php echo e(asset('assets/panel/images/img.jpg')); ?>" alt="Profile Image" /></span>
                        <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="image"><img src="<?php echo e(asset('assets/panel/images/image.jpg')); ?>" alt="Profile Image" /></span>
                        <span>
                            <span>Shabnam Masuma</span>
                            <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="image"><img src="<?php echo e(asset('assets/panel/images/img.jpg')); ?>" alt="Profile Image" /></span>
                        <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                </li>
                <li>
                    <div class="text-center">
                        <a>
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views/panel/includes/top_nav.blade.php ENDPATH**/ ?>