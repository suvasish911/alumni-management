<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    </style>

</head>
<body>



        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">

                <a class="navbar-brand" href="#">
                    Alumni Management System
                </a>

                <button class="navbar-toggler"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#events">Events</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white ms-2 px-3"
                            href="{{ route('register') }}">
                                Register
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>


        <!-- Hero Section -->
        <section class="hero">

            <div>

                <h1 class="display-3 fw-bold">
                    Welcome Alumni
                </h1>

                <p class="lead">
                    Connecting Alumni, Strengthening Networks,
                    Building the Future.
                </p>

                <a href="{{ route('register') }}"
                class="btn btn-primary btn-lg">

                    Join Alumni Network

                </a>

            </div>

        </section>


        <!-- Statistics -->
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


        <!-- About -->
        <section id="about" class="bg-light py-5">

            <div class="container">

                <h2 class="text-center mb-4">
                    About Alumni Association
                </h2>

                <p class="text-center">

                    Our Alumni Management System helps graduates
                    stay connected with the university, participate
                    in events, contribute through donations,
                    and maintain strong professional networks.

                </p>

            </div>

        </section>


        <!-- Upcoming Events -->
        <section id="events" class="container py-5">

            <h2 class="text-center mb-5">
                Upcoming Events
            </h2>

            <div class="row">

                <div class="col-md-4">

                    <div class="card shadow">

                        <div class="card-body">

                            <h5>Annual Alumni Reunion</h5>

                            <p>
                                Meet old friends and faculty members.
                            </p>

                            <small>July 15, 2026</small>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card shadow">

                        <div class="card-body">

                            <h5>Career Networking Seminar</h5>

                            <p>
                                Build professional connections.
                            </p>

                            <small>August 10, 2026</small>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card shadow">

                        <div class="card-body">

                            <h5>Scholarship Fundraising</h5>

                            <p>
                                Support current students.
                            </p>

                            <small>September 05, 2026</small>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- Committee -->
        <section class="bg-light py-5">

            <div class="container">

                <h2 class="text-center mb-5">
                    Executive Committee
                </h2>

                <div class="row text-center">

                    <div class="col-md-4">

                        <div class="card shadow">

                            <div class="card-body">

                                <h5>President</h5>

                                <p>John Doe</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card shadow">

                            <div class="card-body">

                                <h5>Treasurer</h5>

                                <p>Sarah Ahmed</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

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


        <!-- Donation CTA -->
        <section class="container py-5 text-center">

            <h2>
                Support Future Generations
            </h2>

            <p>
                Help students through scholarships
                and university development projects.
            </p>

            <a href="{{ route('login') }}"
            class="btn btn-success btn-lg">

                Donate Now

            </a>

        </section>


        <!-- Footer -->
        <footer>

            <div class="container text-center">

                <h5>Alumni Management System</h5>

                <p>
                    Connecting Alumni Across Generations
                </p>

                <small>
                    © {{ date('Y') }} All Rights Reserved
                </small>

            </div>

        </footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
