<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alumni Management System | Home</title>

    <link href="<?php echo e(asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    
    <style>
        body {
            background: #F7F7F7;
            font-family: "Helvetica Neue", Roboto, Arial, "Noto Sans", sans-serif;
            color: #73879C;
        }
        /* Top Navigation Header bar using Gentelella Dark Sidebar theme */
        .custom-header {
            background: #2A3F54;
            padding: 15px 0;
            border-bottom: 3px solid #1ABB9C;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .brand-logo {
            color: #ECF0F1;
            font-size: 22px;
            font-weight: 600;
            text-decoration: none !important;
        }
        .brand-logo i {
            color: #1ABB9C;
            margin-right: 5px;
        }
        .nav-links a {
            color: #ECF0F1;
            font-weight: 500;
            font-size: 14px;
            margin-left: 20px;
            text-decoration: none;
            transition: 0.3s;
        }
        .nav-links a:hover {
            color: #1ABB9C;
        }
        /* Hero Branding Jumbotron Section */
        .hero-banner {
            background: #2A3F54;
            color: #ECF0F1;
            padding: 90px 0;
            text-align: center;
            border-bottom: 1px solid #D9DEE4;
            position: relative;
        }
        .hero-banner h1 {
            font-weight: 700;
            font-size: 42px;
            margin-bottom: 15px;
        }
        .hero-banner p {
            font-size: 18px;
            color: #BDC3C7;
            max-width: 700px;
            margin: 0 auto 30px auto;
        }
        /* Feature Cards mimicking Gentelella x_panel summary blocks */
        .info-card {
            background: #ffffff;
            border: 1px solid #E6F0F3;
            padding: 30px 20px;
            border-radius: 3px;
            text-align: center;
            margin-top: 40px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .info-card:hover {
            border-color: #1ABB9C;
            transform: translateY(-3px);
        }
        .info-card .icon-box {
            font-size: 36px;
            color: #1ABB9C;
            margin-bottom: 15px;
        }
        .info-card h3 {
            color: #2A3F54;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 10px;
        }
        /* Buttons following layout classes */
        .btn-gentle-success {
            background: #1ABB9C;
            border: 1px solid #1ABB9C;
            color: #FFF !important;
            font-weight: 500;
        }
        .btn-gentle-success:hover {
            background: #15967D;
            border-color: #15967D;
        }
        .btn-gentle-outline {
            background: transparent;
            border: 1px solid #ECF0F1;
            color: #ECF0F1 !important;
            font-weight: 500;
        }
        .btn-gentle-outline:hover {
            background: #ECF0F1;
            color: #2A3F54 !important;
        }
        footer {
            background: #ffffff;
            padding: 20px 0;
            border-top: 1px solid #D9DEE4;
            margin-top: 80px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <header class="custom-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12 text-right-sm text-left-sm">
                    <a href="<?php echo e(url('/')); ?>" class="brand-logo">
                        <i class="fa fa-graduation-cap"></i> ALUMNI <span>PORTAL</span>
                    </a>
                </div>
                <div class="col-sm-6 col-xs-12 text-right text-right-sm nav-links" style="margin-top: 5px;">
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>"><i class="fa fa-sign-in"></i> Log In</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>"><i class="fa fa-user-plus"></i> Register</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <section class="hero-banner">
        <div class="container">
            <h1>Stay Connected, Stay Inbound</h1>
            <p>Welcome to the official Alumni Hub. Expand your network, keep tabs on campus events, and coordinate registration fees seamlessly with our financial department layout.</p>
            <div>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-lg btn-gentle-success"><i class="fa fa-dashboard m-right-xs"></i> Go to Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-lg btn-gentle-success" style="margin-right: 10px;"><i class="fa fa-sign-in m-right-xs"></i> Sign In</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-lg btn-gentle-outline"><i class="fa fa-edit m-right-xs"></i> Join Network</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <main class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-card">
                    <div class="icon-box"><i class="fa fa-calendar"></i></div>
                    <h3>Event Scheduling</h3>
                    <p>Track current events, secure custom reservation slots, and look up scheduling coordinates easily.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-card">
                    <div class="icon-box"><i class="fa fa-money"></i></div>
                    <h3>Account Verification</h3>
                    <p>Invoices monitored securely by assigned <code>account_officer</code> profiles to ensure clean payment logging.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="info-card">
                    <div class="icon-box"><i class="fa fa-users"></i></div>
                    <h3>Alumni Network</h3>
                    <p>Manage community records, filter verified alumni credentials, and stay up to date with updates.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center">
        <div class="container">
            <div class="pull-left">
                Alumni Management System — Gentelella Styled Core Layout
            </div>
            <div class="pull-right">
                &copy; <?php echo e(date('Y')); ?> All Rights Reserved.
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>

    <script src="<?php echo e(asset('assets/vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views/welcome.blade.php ENDPATH**/ ?>