<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Management System</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #2A3F54; }
        .navbar-custom { background-color: #2A3F54; border: none; margin-bottom: 0; border-radius: 0; }
        .navbar-custom .navbar-brand, .navbar-custom .nav>li>a { color: #fff; }
        .navbar-custom .nav>li>a:hover { background-color: #1A2A3A; color: #fff; }
        
        .hero-section {
            background: linear-gradient(rgba(42, 63, 84, 0.85), rgba(26, 42, 58, 0.9)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1200') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero-section h1 { font-size: 45px; font-weight: 700; margin-bottom: 20px; }
        .hero-section p { font-size: 18px; margin-bottom: 30px; opacity: 0.9; }
        
        .feature-card { background: #f9f9f9; padding: 30px 20px; border-radius: 4px; text-align: center; margin-bottom: 30px; border-bottom: 3px solid #2A3F54; transition: 0.3s; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .feature-card i { font-size: 40px; color: #1ABB9C; margin-bottom: 15px; }
        
        .footer { background: #2A3F54; color: #E7E7E7; padding: 20px 0; margin-top: 50px; text-align: center; }
    </style>
</head>
<body>

    <nav class="navbar navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><i class="fa fa-graduation-cap"></i> Alumni Portal</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <li><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo e(route('login')); ?>"><i class="fa fa-sign-in"></i> Login</a></li>
                            <?php if(Route::has('register')): ?>
                                <li><a href="<?php echo e(route('register')); ?>"><i class="fa fa-user-plus"></i> Register</a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1>Welcome Back, Alumni!</h1>
            <p>Stay connected with your alma mater, network with fellow graduates, and register for upcoming events seamlessly.</p>
            <div>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-success btn-lg">Go to Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg" style="margin-right: 10px;">Sign In</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-default btn-lg">Join Network</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <section class="container" style="margin-top: 60px;">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 style="font-weight:700; margin-bottom: 40px;">Portal Core Modules</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fa fa-calendar"></i>
                    <h3>Event Management</h3>
                    <p>Browse through upcoming campus meets, reunions, and events. Secure your seats easily.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fa fa-money"></i>
                    <h3>Secure Payments</h3>
                    <p>Transparent fee systems monitored directly by our Account Officers for accurate invoicing.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fa fa-users"></i>
                    <h3>Alumni Network</h3>
                    <p>Connect with professional peers, access mentoring opportunities, and tracking channels.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo e(date('Y')); ?> Alumni Management System. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html><?php /**PATH C:\xampp\htdocs\alumni-management\resources\views\welcome.blade.php ENDPATH**/ ?>