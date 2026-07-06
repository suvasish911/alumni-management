<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | Alumni System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* আপনার দেওয়া সাইডবারের হুবহু সিএসএস স্টাইল */
        .main_menu_side {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #0f172a !important; 
            padding: 5px 10px;
            min-width: 260px;
            max-width: 260px;
            position: fixed;
            height: 100vh;
            z-index: 999;
            overflow-y: auto;
        }
        
        .menu_section h3 {
            font-size: 0.7rem !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b !important;
            font-weight: 700;
            margin-bottom: 10px;
            margin-top: 15px;
            padding-left: 12px;
        }
        
        .side-menu {
            padding-left: 0;
            list-style: none;
            margin: 0;
        }
        
        .side-menu > li {
            margin-bottom: 4px;
            position: relative;
        }
        
        .side-menu > li > a {
            color: #94a3b8 !important;
            font-weight: 500;
            font-size: 0.88rem;
            padding: 12px 15px !important;
            display: flex;
            align-items: center;
            border-radius: 8px;
            transition: all 0.25s ease;
            text-decoration: none;
            background: transparent !important;
        }
        
        .side-menu > li > a:hover {
            background: rgba(255, 255, 255, 0.04) !important;
            color: #f8fafc !important;
        }
        
        .side-menu > li.active > a,
        .side-menu > li > a:focus {
            background: rgba(255, 255, 255, 0.06) !important;
            color: #ffffff !important;
            font-weight: 600;
            border-left: 3px solid #cbd5e1 !important;
        }
        
        .side-menu i {
            font-size: 1rem;
            width: 24px;
            color: #475569;
            transition: color 0.25s ease;
        }
        
        .side-menu > li > a:hover i,
        .side-menu > li.active i {
            color: #cbd5e1;
        }
        
        .child_menu {
            background: rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px;
            margin-top: 4px;
            padding: 5px 0 5px 10px !important;
            list-style: none;
        }
        
        .child_menu li a {
            color: #64748b !important;
            font-size: 0.85rem;
            padding: 8px 12px !important;
            display: block;
            text-decoration: none;
            transition: all 0.2s ease;
            border-radius: 4px;
        }
        
        .child_menu li a:hover {
            color: #f8fafc !important;
            padding-left: 16px !important;
        }
        
        .fa-chevron-down {
            margin-left: auto;
            font-size: 0.7rem !important;
            width: auto !important;
        }
        
        .role-indicator-badge {
            font-size: 0.6rem;
            font-weight: 700;
            background: rgba(148, 163, 184, 0.1);
            color: #94a3b8;
            padding: 2px 6px;
            border-radius: 4px;
            letter-spacing: 0.5px;
            margin-left: 6px;
            display: inline-block;
            vertical-align: middle;
        }

        /* ─── WORKSPACE CONTENT AREA ─── */
        body {
            background-color: #f8fafc;
            color: #334155;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            overflow-x: hidden;
            margin: 0;
        }

        .wrapper {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }

        #content {
            width: 100%;
            padding: 40px;
            margin-left: 260px;
            min-height: 100vh;
            background-color: #f8fafc;
        }

        .page-header-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 25px;
        }

        .config-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            padding: 24px;
            margin-bottom: 24px;
        }

        .config-card-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #0f172a;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-stream-box {
            position: relative;
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .avatar-preview-element {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e2e8f0;
        }

        .avatar-trigger-label {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #0f172a;
            color: #fff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            cursor: pointer;
            border: 2px solid #fff;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-control {
            border-color: #cbd5e1;
            padding: 10px 14px;
            font-size: 0.92rem;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
        }

        .btn-update-submit {
            background-color: #0f172a;
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 8px;
            border: none;
            transition: background 0.2s;
        }

        .btn-update-submit:hover {
            background-color: #1e293b;
        }

        @media (max-width: 768px) {
            .main_menu_side { display: none; }
            #content { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- ─── আপনার দেওয়া সাইডবার ডাইরেক্টরিভ লেআউট[cite: 3] ─── -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
              <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
              </li>
              <li class="{{ Request::routeIs('general.events.index') ? 'active' : '' }}">
                <a href="{{ route('general.events.index') }}"><i class="fa fa-calendar"></i> Events List</a>
              </li>
            </ul>
          </div>

          @if(Auth::user()?->role === 'admin')
          <div class="menu_section">
            <h3>Administration <span class="role-indicator-badge">ADMIN</span></h3>
            <ul class="nav side-menu">
              <li class="{{ Request::routeIs('admin.events.index') ? 'active' : '' }}">
                <a href="{{ route('admin.events.index') }}"><i class="fa fa-calendar"></i> Events Management</a>
              </li>
              
              <li class="{{ request()->is('admin/donations*') || request()->is('admin/donation-projects*') ? 'active' : '' }}">
                <a><i class="fa fa-hand-holding-usd"></i> Donations Control <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{ route('admin.projects.index') }}">Donation Projects</a></li>
                  <li><a href="{{ route('admin.donations.history') }}">History Logs</a></li>
                  <li><a href="{{ route('admin.donations.report') }}">Financial Reports</a></li>
                </ul>
              </li>

             <li class="{{ request()->is('admin/approvals*') ? 'active' : '' }}">
                <a><i class="fa fa-users"></i> Alumni Control <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{ route('admin.approvals.index') }}"><i class="fa fa-check-square-o"></i> Pending Approvals</a></li>
                  <li><a href="{{ route('admin.alumni.registry') }}">All Members Registry</a></li>
                </ul>
              </li>
            </ul>
          </div>
          @endif

          @if(Auth::user()?->role === 'alumni')
          <div class="menu_section">
            <h3>Alumni Desk <span class="role-indicator-badge">MEMBER</span></h3>
            <ul class="nav side-menu">
              <li class="{{ Request::routeIs('alumni.events.index') ? 'active' : '' }}">
                <a href="{{ route('alumni.events.index') }}"><i class="fa fa-ticket"></i> Join Events / RSVP</a>
              </li>

              <li class="{{ Request::routeIs('alumni.events.my_events') ? 'active' : '' }}">
                <a href="{{ route('alumni.events.my_events') }}"><i class="fa fa-calendar-check-o"></i> My Registered Events</a>
              </li>

              <li class="{{ Request::routeIs('alumni.donations.index') ? 'active' : '' }}">
                <a href="{{ route('alumni.donations.index') }}"><i class="fa fa-heart"></i> Donations and Giving</a>
              </li>

              <li class="{{ Request::routeIs('alumni.contributions') ? 'active' : '' }}">
                <a href="{{ route('alumni.contributions') }}"><i class="fa-solid fa-history"></i> My Contributions</a>
              </li>

              <li class="active">
                <a href="#"><i class="fa fa-user"></i> Profile Settings</a>
              </li>
            </ul>
          </div>
          @endif
        </div>

        <!-- ─── ডানপাশের ফর্ম উইন্ডো ─── -->
        <div id="content">
            <div class="container-fluid p-0" style="max-width: 900px;">
                
                <h1 class="page-header-title">Profile Settings</h1>

                <!-- ইরো ও সাকসেস মেসেজ হ্যান্ডলিং (image_07c8b9.png এর স্টাইল অনুযায়ী) -->
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 small" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 small" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- ১. প্রোфাইল ইমেজ কার্ড -->
                    <div class="config-card">
                        <div class="config-card-title text-dark"><i class="fa-solid fa-camera text-secondary"></i> Change Profile Photo</div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar-stream-box">
                                <img id="avatarPreview" class="avatar-preview-element" 
                                     src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=f1f5f9&color=0f172a' }}" alt="Profile">
                                <label for="profile_image_input" class="avatar-trigger-label"><i class="fa-solid fa-pencil"></i></label>
                                <input type="file" id="profile_image_input" name="profile_image" class="d-none" accept="image/*" onchange="readStream(this)">
                            </div>
                            <div>
                                <h6 class="fw-bold m-0" style="color: #0f172a;">{{ auth()->user()->name }}</h6>
                                <p class="text-muted small m-0">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- ২. কন্টাক্ট এবং জেনারেল ফিল্ডস (ইমেইল ফিল্ডসহ ফিক্সড) -->
                    <div class="config-card">
                        <div class="config-card-title"><i class="fa-solid fa-address-book text-muted"></i> Personal Info & Contact</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="e.g. 017XXXXXXXX">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Current Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address', auth()->user()->address) }}" placeholder="e.g. Dhaka, Bangladesh">
                            </div>
                        </div>
                    </div>

                    <!-- ৪. প্রফেশনাল ফিল্ডস -->
                    <div class="config-card">
                        <div class="config-card-title"><i class="fa-solid fa-briefcase text-muted"></i> Professional Matrix</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Current Company / Organization</label>
                                <input type="text" class="form-control" name="company" value="{{ old('company', auth()->user()->company) }}" placeholder="e.g. Tech Solutions Ltd.">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation" value="{{ old('designation', auth()->user()->designation) }}" placeholder="e.g. Software Engineer">
                            </div>
                        </div>
                    </div>

                    <!-- ৫. রিড-অনলি academic ট্র্যাক -->
                    <div class="config-card bg-light-subtle">
                        <div class="config-card-title text-secondary"><i class="fa-solid fa-graduation-cap"></i> Academic Identity Registry</div>
                        <div class="row g-3">
                            <div class="col-md-3 col-6">
                                <label class="form-label text-muted">Student ID</label>
                                <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->student_id ?? 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label text-muted">Department</label>
                                <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->department ?? 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label text-muted">Batch</label>
                                <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->batch ?? 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label text-muted">Session</label>
                                <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->session ?? 'N/A' }}" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- ৩. সিকিউরিটি / পাসওয়ার্ড ফিল্ডস -->
                    <div class="config-card">
                        <div class="config-card-title"><i class="fa-solid fa-lock text-muted"></i> Security & Credentials</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat new password">
                            </div>
                        </div>
                    </div>

                    <!-- সাবমিট বাটন -->
                    <div class="text-end mb-5">
                        <button type="submit" class="btn-update-submit shadow-sm">Save Profile Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function readStream(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>