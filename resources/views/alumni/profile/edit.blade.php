@extends('panel.layout')

@section('content')
<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Profile Settings</h3>
            <p class="text-muted small" style="margin-top: 5px;">Manage your registration details, professional info, and account security</p>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 3px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 25px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                
                <!-- Notice enctype for file upload -->
                <form action="{{ route('alumni.profile.update') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    @csrf
                    @method('PUT')

                    <!-- SECTION 1: Personal & Photo -->
                    <h4 style="color: #2A3F54; border-bottom: 2px solid #2A3F54; padding-bottom: 5px; margin-bottom: 20px;"><i class="fa fa-user"></i> Personal Information</h4>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Current Profile Photo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div style="margin-bottom: 10px;">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc;">
                                @else
                                    <div style="width: 100px; height: 100px; border-radius: 50%; background: #eee; text-align: center; line-height: 100px; color: #aaa; font-weight: bold;">No Image</div>
                                @endif
                            </div>
                            <input type="file" name="profile_image" class="form-control" accept="image/*">
                            <span class="small text-muted">Max size 2MB (jpeg, png, jpg)</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name <span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" placeholder="e.g. +88017XXXXXXXX">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="address" class="form-control" rows="2" placeholder="Your current address">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>

                    <!-- SECTION 2: Academic Info (From Registration) -->
                    <h4 style="color: #2A3F54; border-bottom: 2px solid #2A3F54; padding-bottom: 5px; margin-top: 35px; margin-bottom: 20px;"><i class="fa fa-graduation-cap"></i> Academic Information</h4>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID <span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="student_id" value="{{ old('student_id', $user->student_id) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Department <span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="department" value="{{ old('department', $user->department) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Batch <span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="batch" value="{{ old('batch', $user->batch) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Session <span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="session" value="{{ old('session', $user->session) }}" class="form-control" required>
                        </div>
                    </div>

                    <!-- SECTION 3: Professional Info (Requested) -->
                    <h4 style="color: #2A3F54; border-bottom: 2px solid #2A3F54; padding-bottom: 5px; margin-top: 35px; margin-bottom: 20px;"><i class="fa fa-briefcase"></i> Professional Details</h4>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Current Company / Org</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="company" value="{{ old('company', $user->company) }}" class="form-control" placeholder="e.g. Tech Solutions Ltd.">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Designation</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="designation" value="{{ old('designation', $user->designation) }}" class="form-control" placeholder="e.g. Software Engineer">
                        </div>
                    </div>

                    <!-- SECTION 4: Security -->
                    <h4 style="color: #2A3F54; border-bottom: 2px solid #2A3F54; padding-bottom: 5px; margin-top: 35px; margin-bottom: 20px;"><i class="fa fa-lock"></i> Security & Password</h4>
                    <p class="text-warning col-md-offset-3 col-sm-offset-3" style="font-size: 12px; margin-bottom: 15px;"><i class="fa fa-info-circle"></i> Leave blank if you don't want to change your password.</p>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" name="password" class="form-control" placeholder="Minimum 8 characters">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Re-type new password">
                        </div>
                    </div>

                    <div class="ln_solid" style="margin-top: 30px;"></div>
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                            <button type="submit" class="btn btn-success" style="background-color: #26b99a; border-color: #169f85; padding: 8px 25px; font-weight: bold;">
                                <i class="fa fa-save"></i> Save Profile Settings
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection