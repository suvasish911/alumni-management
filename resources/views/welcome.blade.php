<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .hero{
            background: linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
            url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1');
            background-size: cover;
            background-position: center;
            height: 80vh;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
        }

        .stat-card{
            transition:.3s;
        }

        .stat-card:hover{
            transform:translateY(-5px);
        }

        footer{
            background:#212529;
            color:white;
            padding:20px 0;
        }

        /* Form styling inside modal */
        .form-section-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 12px;
            display: block;
        }
        .file-upload-wrapper {
            border: 2px dashed #dee2e6;
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            position: relative;
            cursor: pointer;
            transition: 0.2s;
        }
        .file-upload-wrapper:hover {
            background-color: #e9ecef;
            border-color: #0d6efd;
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Alumni Management System
                </a>

                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#events">Events</a>
                        </li>
                        
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-light ms-2 px-3" href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <button class="nav-link btn btn-primary text-white ms-2 px-3" data-bs-toggle="modal" data-bs-target="#registerModal">
                                            Register
                                        </button>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        <section class="hero">
            <div>
                <h1 class="display-3 fw-bold">Welcome Alumni</h1>
                <p class="lead">Connecting Alumni, Strengthening Networks, Building the Future.</p>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
                @else
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#registerModal">
                        Join Alumni Network
                    </button>
                @endauth
            </div>
        </section>


        <section class="container py-5">
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h2>500+</h2>
                            <p>Total Alumni</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h2>50+</h2>
                            <p>Events</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h2>15</h2>
                            <p>Departments</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h2>100K+</h2>
                            <p>Donations</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="about" class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">About Alumni Association</h2>
                <p class="text-center">
                    Our Alumni Management System helps graduates stay connected with the university, participate
                    in events, contribute through donations, and maintain strong professional networks.
                </p>
            </div>
        </section>


        <section id="events" class="container py-5">
            <h2 class="text-center mb-5">Upcoming Events</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Annual Alumni Reunion</h5>
                            <p>Meet old friends and faculty members.</p>
                            <small class="text-muted">July 15, 2026</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Career Networking Seminar</h5>
                            <p>Build professional connections.</p>
                            <small class="text-muted">August 10, 2026</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Scholarship Fundraising</h5>
                            <p>Support current students.</p>
                            <small class="text-muted">September 05, 2026</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-5">Executive Committee</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>President</h5>
                                <p>John Doe</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Treasurer</h5>
                                <p>Sarah Ahmed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Secretary</h5>
                                <p>Michael Smith</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="container py-5 text-center">
            <h2>Support Future Generations</h2>
            <p>Help students through scholarships and university development projects.</p>
            <a href="{{ route('login') }}" class="btn btn-success btn-lg">Donate Now</a>
        </section>


        @if (!Auth::check() && Route::has('register'))
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header border-0 pb-0 mt-2 px-4">
                        <div>
                            <h4 class="modal-title fw-bold text-dark" id="registerModalLabel">Create Alumni Account</h4>
                            <p class="text-muted small mb-0">Please fill in your academic details to register for verification.</p>
                        </div>
                        <button type="button" class="btn-close mb-4" data-bs-redirect="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body p-4">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label small fw-bold text-secondary">Full Name</label>
                                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label small fw-bold text-secondary">Email Address</label>
                                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded-3 mb-4 border">
                                <span class="form-section-title"><i class="fa-solid fa-graduation-cap me-1"></i> Academic Credentials</span>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="student_id" class="form-label small fw-bold text-secondary">Student ID</label>
                                        <input id="student_id" class="form-control form-control-sm" type="text" name="student_id" required placeholder="e.g. 180101" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="batch" class="form-label small fw-bold text-secondary">Batch</label>
                                        <input id="batch" class="form-control form-control-sm" type="text" name="batch" required placeholder="e.g. 45th" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="session" class="form-label small fw-bold text-secondary">Session</label>
                                        <input id="session" class="form-control form-control-sm" type="text" name="session" required placeholder="e.g. 2018-19" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="profile_image" class="form-label small fw-bold text-secondary">Profile Picture</label>
                                <div class="file-upload-wrapper">
                                    <i class="fa-regular fa-image fa-2x text-muted mb-2 d-block"></i>
                                    <span class="text-primary small fw-semibold">Click to upload your photo</span>
                                    <p class="text-muted text-xs mb-0 mt-1" style="font-size: 0.75rem;">PNG, JPG, JPEG up to 2MB</p>
                                    <input id="profile_image" type="file" name="profile_image" accept="image/*">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="password" class="form-label small fw-bold text-secondary">Password</label>
                                    <input id="password" class="form-control" type="password" name="password" required placeholder="••••••••" autocomplete="new-password" />
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label small fw-bold text-secondary">Confirm Password</label>
                                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="••••••••" autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <a class="text-decoration-none text-secondary small" href="{{ route('login') }}">
                                    Already registered?
                                </a>
                                <div>
                                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary px-4 fw-semibold">Submit Registration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif


        <footer>
            <div class="container text-center">
                <h5>Alumni Management System</h5>
                <p>Connecting Alumni Across Generations</p>
                <small>© {{ date('Y') }} All Rights Reserved</small>
            </div>
        </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('registerModal'));
        myModal.show();
    });
</script>
@endif

</body>
</html>