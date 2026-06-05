<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Bootstrap</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">MyApp</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container text-center mt-5">
        <h1 class="mb-3">Welcome to Laravel 🚀</h1>
        <p class="lead">This is a simple Bootstrap UI</p>
        <button class="btn btn-primary">Get Started</button>
    </div>

    <!-- Cards -->
    <div class="container mt-5">
        <div class="row">
            
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Feature 1</h5>
                    <p>Simple and clean design.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Feature 2</h5>
                    <p>Easy to customize.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Feature 3</h5>
                    <p>Responsive layout.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center mt-5 p-3">
        <p>© 2026 MyApp | Built with Laravel</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>