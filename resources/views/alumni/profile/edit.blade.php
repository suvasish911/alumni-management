@extends('panel.layout')

@section('content')
<style>
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
</style>

<div class="" role="main">
    <div class="container-fluid p-0" style="max-width: 900px; margin-top: 15px;">
        
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin-bottom: 25px;">Profile Settings</h1>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 small" role="alert">
                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
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

            <div class="config-card">
                <div class="config-card-title text-dark"><i class="fa fa-camera text-secondary"></i> Change Profile Photo</div>
                <div class="d-flex align-items-center gap-4" style="display: flex; align-items: center; gap: 20px;">
                    <div class="avatar-stream-box">
                        <img id="avatarPreview" class="avatar-preview-element" 
                             src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=f1f5f9&color=0f172a' }}" alt="Profile">
                        <label for="profile_image_input" class="avatar-trigger-label"><i class="fa fa-pencil"></i></label>
                        <input type="file" id="profile_image_input" name="profile_image" class="d-none" style="display: none;" accept="image/*" onchange="readStream(this)">
                    </div>
                    <div>
                        <h6 class="fw-bold m-0" style="color: #0f172a; font-weight: bold; margin: 0;">{{ auth()->user()->name }}</h6>
                        <p class="text-muted small m-0" style="margin: 0; color: #64748b;">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="config-card">
                <div class="config-card-title"><i class="fa fa-address-book text-muted"></i> Personal Info & Contact</div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 15px;">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 15px;">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 15px;">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="e.g. 017XXXXXXXX">
                    </div>
                    <div class="col-md-12" style="margin-bottom: 15px;">
                        <label class="form-label">Current Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address', auth()->user()->address) }}" placeholder="e.g. Dhaka, Bangladesh">
                    </div>
                </div>
            </div>

            <div class="config-card">
                <div class="config-card-title"><i class="fa fa-briefcase text-muted"></i> Professional Matrix</div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 15px;">
                        <label class="form-label">Current Company / Organization</label>
                        <input type="text" class="form-control" name="company" value="{{ old('company', auth()->user()->company) }}" placeholder="e.g. Tech Solutions Ltd.">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 15px;">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" value="{{ old('designation', auth()->user()->designation) }}" placeholder="e.g. Software Engineer">
                    </div>
                </div>
            </div>

            <div class="config-card bg-light-subtle">
                <div class="config-card-title text-secondary"><i class="fa fa-graduation-cap"></i> Academic Identity Registry</div>
                <div class="row">
                    <div class="col-md-3 col-xs-6" style="margin-bottom: 15px;">
                        <label class="form-label text-muted">Student ID</label>
                        <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->student_id ?? 'N/A' }}" disabled style="background-color: #f1f5f9; color: #64748b;">
                    </div>
                    <div class="col-md-3 col-xs-6" style="margin-bottom: 15px;">
                        <label class="form-label text-muted">Department</label>
                        <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->department ?? 'N/A' }}" disabled style="background-color: #f1f5f9; color: #64748b;">
                    </div>
                    <div class="col-md-3 col-xs-6" style="margin-bottom: 15px;">
                        <label class="form-label text-muted">Batch</label>
                        <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->batch ?? 'N/A' }}" disabled style="background-color: #f1f5f9; color: #64748b;">
                    </div>
                    <div class="col-md-3 col-xs-6" style="margin-bottom: 15px;">
                        <label class="form-label text-muted">Session</label>
                        <input type="text" class="form-control bg-light text-secondary" value="{{ auth()->user()->session ?? 'N/A' }}" disabled style="background-color: #f1f5f9; color: #64748b;">
                    </div>
                </div>
            </div>

            <div class="config-card">
                <div class="config-card-title"><i class="fa fa-lock text-muted"></i> Security & Credentials</div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 15px;">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 15px;">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat new password">
                    </div>
                </div>
            </div>

            <div class="text-right" style="text-align: right; margin-bottom: 40px;">
                <button type="submit" class="btn-update-submit shadow-sm">Save Profile Changes</button>
            </div>

        </form>
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
@endsection