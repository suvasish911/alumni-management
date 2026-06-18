<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8fafc; /* Soothing soft gray background */
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #334155;
        }

        .navbar {
            background-color: #0f172a !important; /* Deep elegant dark slate */
            padding: 15px 0;
        }

        .hero {
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.9)),
            url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1');
            background-size: cover;
            background-position: center;
            height: 35vh; /* Balanced, less aggressive height */
            color: white;
            display: flex;
            align-items: center;
        }

        /* Dynamic Profile Widget */
        .user-profile-widget {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            background: #f1f5f9;
        }

        /* Minimalist Workspace Panel */
        .workspace-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        /* Sleek & Calming Action Links */
        .action-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: block;
            height: 100%;
        }

        .action-card:hover {
            transform: translateY(-3px);
            border-color: #cbd5e1;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .action-icon {
            background: #f1f5f9;
            color: #475569;
            width: 44px;
            height: 44px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 15px;
            transition: all 0.25s ease;
        }

        .action-card:hover .action-icon {
            background: #0f172a;
            color: #ffffff;
        }

        .action-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .action-desc {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0;
            line-height: 1.4;
        }

        /* Metric Tracker Display Boxes */
        .stat-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 500;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            position: relative;
            margin-bottom: 35px;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 35px;
            height: 3px;
            background: #64748b;
            border-radius: 2px;
        }

        .event-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 24px;
            height: 100%;
        }

        /* Custom Hover Zoom Handling For Interactive Event Cards */
        .event-card-clickable {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        
        .event-card-clickable-guest {
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .event-card-clickable-guest:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 30px 0;
            font-size: 0.85rem;
            border-top: 1px solid #1e293b;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-semibold text-uppercase tracking-wider fs-6" href="#">Alumni Portal</a>
            <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#events">Events</a></li>
                    
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown ms-2">
                                <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2 px-3 py-2 border-0" 
                                        type="button" 
                                        id="navbarUserDropdown" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false"
                                        style="background: rgba(255, 255, 255, 0.08); border-radius: 20px;">
                                    <i class="fa-regular fa-circle-user text-warning fs-6"></i>
                                    <span class="text-white small fw-medium">{{ auth()->user()->name }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2" 
                                    aria-labelledby="navbarUserDropdown" 
                                    style="border-radius: 12px; min-width: 180px; font-size: 14px;">
                                    <li>
                                        <a class="dropdown-item py-2 rounded d-flex align-items-center gap-2" href="#">
                                            <i class="fa fa-th-large text-muted" style="width: 20px;"></i> Workspace
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider my-1" style="border-color: #f1f5f9;"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form-nav">
                                            @csrf
                                            <a class="dropdown-item py-2 text-danger d-flex align-items-center gap-2 fw-medium rounded" 
                                               href="#" 
                                               onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                                                <i class="fa-solid fa-arrow-right-from-bracket" style="width: 20px;"></i> Sign Out
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item ms-2">
                                <button class="btn btn-link nav-link text-white-50 px-3" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</button>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <button class="btn btn-sm btn-light text-dark fw-medium ms-2 px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#registerModal">Join Network</button>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container px-4">
            @auth
                <div class="user-profile-widget">
                    <img class="user-avatar" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=f1f5f9&color=475569' }}" alt="Profile">
                    <div>
                        <h2 class="m-0 fw-semibold text-white">Welcome back, {{ auth()->user()->name }}</h2>
                        <p class="text-white-50 small m-0 mt-1">Logged into your dedicated configuration workspace.</p>
                    </div>
                </div>
            @else
                <div class="text-center w-100">
                    <h2>University Alumni Hub</h2>
                    <p class="lead text-white-50 fs-6 mt-1">Reuniting generations, fostering collaborations, and supporting institutional progress.</p>
                    <button class="btn btn-sm btn-light text-dark fw-medium mt-2 px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#registerModal">Get Started</button>
                </div>
            @endauth
        </div>
    </section>

    @auth
    <section class="container my-5">
        <div class="workspace-card">
            
            <div class="row align-items-center border-bottom pb-4 mb-4 g-3">
                <div class="col-md-7">
                    <h5 class="fw-bold text-dark m-0"><i class="fa-solid fa-square-poll-horizontal text-secondary me-2"></i>My Workspace Overview</h5>
                    <p class="text-muted small m-0 mt-1">Real-time accounting entries, management modules, and profile nodes configured for your role.</p>
                </div>
                <div class="col-md-5 text-md-end">
                    @if(auth()->user()->role === 'admin')
                        <span class="badge bg-dark px-3 py-2 rounded-pill font-monospace small"><i class="fa-solid fa-shield-halved me-1"></i> ADMIN PORTAL</span>
                    @else
                        <span class="badge bg-light text-secondary border px-2 py-2 rounded font-monospace mx-1 small">ID: {{ auth()->user()->student_id ?? 'N/A' }}</span>
                        <span class="badge bg-light text-secondary border px-2 py-2 rounded font-monospace small">Batch: {{ auth()->user()->batch ?? 'N/A' }}</span>
                    @endif
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="/admin/approvals" class="action-card">
                            <div class="action-icon"><i class="fa-solid fa-user-check"></i></div>
                            <div class="action-title">Verify Accounts</div>
                            <div class="action-desc">Audit incoming registration records. There are currently <strong>{{ $pending_alumni_count ?? 0 }} requests</strong> awaiting moderation approval.</div>
                        </a>
                    </div>
                    <!-- <div class="col-md-4">
                        <a href="/admin/donations/project_donors" class="action-card">
                            <div class="action-icon"><i class="fa-solid fa-users-gear"></i></div>
                            <div class="action-title">Manage Donations</div>
                            <div class="action-desc">Review system credentials, network registries, and overall profile parameters (<strong>{{ $totalUsers ?? 0 }} profiles active</strong>).</div>
                        </a>
                    </div> -->
                    <div class="col-md-4">
                        <a href="/admin/events/create" class="action-card">
                            <div class="action-icon"><i class="fa-solid fa-calendar-plus"></i></div>
                            <div class="action-title">Create System Event</div>
                            <div class="action-desc">Schedule, launch, or configure upcoming reunion meetups, formal dinners, or fund campaigns.</div>
                        </a>
                    </div>
                </div>

            @elseif(auth()->user()->role === 'alumni' && strtolower(trim(auth()->user()->status)) === 'pending')
                <div class="p-4 text-center rounded-3 bg-light border border-dashed">
                    <i class="fa-solid fa-clock-rotate-left text-secondary fs-4 mb-3 d-block"></i>
                    <h6 class="fw-bold text-dark mb-1">Account Submission Under Review</h6>
                    <p class="text-muted small mx-auto mb-0" style="max-width: 550px;">Your student credentials have been securely logged. Your interaction shortcuts and donation pipelines will activate automatically once verified by an administrative member.</p>
                </div>

            @elseif(auth()->user()->role === 'alumni')
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="/alumni/make-donation" class="action-card">
                            <div class="action-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                            <div class="action-title">Contribute Funds</div>
                            <div class="action-desc">Make a secure financial transaction supporting active institutional scholarship portfolios, initiatives, or welfare funds.</div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/alumni/events" class="action-card">
                            <div class="action-icon"><i class="fa-solid fa-ticket"></i></div>
                            <div class="action-title">Join Active Events</div>
                            <div class="action-desc">Browse upcoming reunions, reserve your admission seats, and access logged RSVP verification vouchers.</div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/alumni/my_contributions" class="action-card">
                            <div class="action-icon"><i class="fa-solid fa-receipt"></i></div>
                            <div class="action-title">My Contributions</div>
                            <div class="action-desc">Review your verified transaction reports, statements, and contribution metrics logged in the database.</div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endauth

    <section class="container my-5 text-center">
        <div class="row g-4 text-start">
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="stat-number">{{ $totalUsers ?? '0' }}</div>
                    <div class="stat-label">Total Alumni</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="stat-number">{{ $eventsCount ?? 0 }}</div>
                    <div class="stat-label">Events Hosted</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="stat-number">{{ $departmentsCount ?? 15 }}</div>
                    <div class="stat-label">Departments</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="stat-number">{{ $totalGained ?? '0 TK' }}</div>
                    <div class="stat-label">Total Gained (TK)</div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-5 bg-white border-top border-bottom">
        <div class="container text-center" style="max-width: 700px;">
            <h3 class="section-title">About the Registry</h3>
            <p class="text-muted small">This is a modern networking platform serving as a bridge between university graduates and educational operations, simplifying profile workflows, event coordination, and transaction monitoring.</p>
        </div>
    </section>

    <section id="events" class="container py-5">
        <h3 class="section-title">Upcoming Association Events</h3>
        <div class="row g-4">
            @forelse($upcoming_events ?? [] as $event)
                <div class="col-md-4">
                    <div class="event-card border shadow-sm p-4 text-start"
                         style="border-radius: 12px;"
                         @guest
                         data-bs-toggle="modal" 
                         data-bs-target="#loginModal"
                         class="event-card event-card-clickable-guest border shadow-sm p-4 text-start"
                         @endguest>
                        
                        <h6 class="fw-bold text-dark mb-2" style="font-size: 17px; color: #1e293b;">
                            {{ $event->name }}
                        </h6>
                        <p class="text-muted small m-0 mb-1">
                            <i class="fa fa-map-marker text-danger me-1"></i> Venue: {{ $event->place }}
                        </p>
                        <p class="text-secondary small m-0 mb-3">
                            Organized By: {{ $event->organized_by }}
                        </p>

                        @guest
                            @if(isset($event->amount) && $event->amount > 0)
                                <div class="badge bg-success mb-3" style="font-size: 11px; padding: 6px 10px; font-weight: 500;">
                                    {{ number_format($event->amount) }} TK Entry Fee
                                </div>
                            @else
                                <div class="badge bg-info text-white mb-3" style="font-size: 11px; padding: 6px 10px; font-weight: 500;">
                                    Free Admission
                                </div>
                            @endif
                        @endguest

                        <div class="text-secondary small pt-2 border-top d-flex justify-content-between align-items-center" style="font-weight: 500;">
                            <span>
                                <i class="fa-regular fa-calendar me-2 text-primary"></i>
                                {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('M d, Y') : 'TBD' }}
                            </span>
                            
                            @guest
                                <span class="text-primary small fw-bold">
                                    Join <i class="fa-solid fa-angle-right ms-1"></i>
                                </span>
                            @endguest
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No upcoming events listed right now.</p>
                </div>
            @endforelse
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <p class="m-0 fw-medium text-white-50">Alumni Association Portal Framework</p>
            <small class="text-secondary d-block mt-1">© {{ date('Y') }} All Rights Reserved</small>
        </div>
    </footer>

    @guest
    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 px-4 pt-4 pb-0">
                    <div>
                        <h5 class="fw-bold text-dark m-0">Create Alumni Account</h5>
                        <p class="text-muted small m-0 mt-1">Submit your academic details below for operational database verification.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-medium">Full Name</label>
                                <input class="form-control" type="text" name="name" required placeholder="e.g. John Doe" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-medium">Email Address</label>
                                <input class="form-control" type="email" name="email" required placeholder="name@example.com" />
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-3 mb-4 border">
                            <span class="text-dark small d-block fw-bold mb-3"><i class="fa-solid fa-graduation-cap text-secondary me-2"></i>Academic Identity Verification</span>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-secondary small">Student ID</label>
                                    <input class="form-control form-control-sm" type="text" name="student_id" required placeholder="e.g. 180101" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-secondary small">Batch</label>
                                    <input class="form-control form-control-sm" type="text" name="batch" required placeholder="e.g. 45th" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-secondary small">Session</label>
                                    <input class="form-control form-control-sm" type="text" name="session" required placeholder="e.g. 2018-19" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-medium">Upload Profile Photo</label>
                            <input class="form-control form-control-sm" type="file" name="profile_image" accept="image/*">
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-medium">Secure Password</label>
                                <input class="form-control" type="password" name="password" required placeholder="••••••••" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-medium">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" required placeholder="••••••••" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-dark px-4">Register Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content">
                <div class="modal-header border-0 px-4 pt-4 pb-0">
                    <div>
                        <h5 class="fw-bold text-dark m-0">Sign In</h5>
                        <p class="text-muted small m-0 mt-1">Access your primary workspace dashboard panel.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-medium">Email Address</label>
                            <input class="form-control" type="email" name="email" required placeholder="name@example.com" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-medium">Password</label>
                            <input class="form-control" type="password" name="password" required placeholder="••••••••" />
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mt-2 py-2 rounded-3">Access Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
