@extends('panel.layout')

@section('content')

<style>
    .custom-pagination .pagination {
        margin-bottom: 0;
    }
    .custom-pagination .page-item.active .page-link {
        background-color: #2A3F54 !important;
        border-color: #2A3F54 !important;
        color: #fff !important;
    }
    .custom-pagination .page-link {
        color: #2A3F54 !important;
        padding: 6px 12px;
        border: 1px solid #dee2e6;
    }
    .custom-pagination .page-link:hover {
        background-color: #f1f5f9 !important;
        border-color: #dee2e6 !important;
    }
    .custom-pagination .page-item.disabled .page-link {
        color: #6c757d !important;
        background-color: #fff !important;
        border-color: #dee2e6 !important;
    }
</style>

<div class="container-fluid" style="padding: 10px 20px;">
    <div class="page-title" style="margin-bottom: 25px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Manage Administrators</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background-color: #26b99a; color: #fff; border-radius: 4px; padding: 12px 20px; margin-bottom: 20px;">
            <i class="fa fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close" style="opacity: 1; float: right; background: none; border: 0; font-size: 20px; line-height: 20px;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- Left Side: Add New Admin Form -->
        <div class="col-md-5 col-sm-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 25px; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); min-height: 520px;">
                <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 12px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">
                        <i class="fa fa-user-plus" style="margin-right: 8px; color: #4a5f73;"></i>Add New Admin
                    </h2>
                    <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                    <form method="POST" action="/admin/manage-admins" enctype="multipart/form-data" id="adminForm">
                        @csrf
                        
                        <div class="form-group text-center" style="margin-bottom: 18px;">
                            <div style="margin-bottom: 10px;">
                                <img id="imagePreview" src="https://ui-avatars.com/api/?name=New+Admin&background=f1f5f9&color=475569" 
                                     alt="Preview" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px dashed #ccc; padding: 3px;">
                            </div>
                            <label class="btn btn-default btn-sm" style="border: 1px solid #ccc; cursor: pointer; font-size: 12px;">
                                <i class="fa fa-camera"></i> Choose Admin Photo
                                <input type="file" name="profile_image" id="profile_image" accept="image/*" style="display: none;" onchange="previewFile()">
                            </label>
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="color: #4a5f73; font-weight: 600; font-size: 13px; display: block; margin-bottom: 6px;">Full Name</label>
                            <input type="text" name="name" class="form-control" style="border: 1px solid #ccc; border-radius: 4px; font-size: 13px; padding: 8px 12px; height: auto;" placeholder="e.g. Admin Name" required autocomplete="off">
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="color: #4a5f73; font-weight: 600; font-size: 13px; display: block; margin-bottom: 6px;">Email Address</label>
                            <input type="email" name="email" class="form-control" style="border: 1px solid #ccc; border-radius: 4px; font-size: 13px; padding: 8px 12px; height: auto;" placeholder="admin@example.com" required autocomplete="off">
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="color: #4a5f73; font-weight: 600; font-size: 13px; display: block; margin-bottom: 6px;">Secure Password</label>
                            <input type="password" name="password" class="form-control" style="border: 1px solid #ccc; border-radius: 4px; font-size: 13px; padding: 8px 12px; height: auto;" placeholder="••••••••" required autocomplete="new-password">
                        </div>

                        <div class="form-group" style="margin-bottom: 22px;">
                            <label style="color: #4a5f73; font-weight: 600; font-size: 13px; display: block; margin-bottom: 6px;">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" style="border: 1px solid #ccc; border-radius: 4px; font-size: 13px; padding: 8px 12px; height: auto;" placeholder="••••••••" required autocomplete="new-password">
                        </div>

                        <button type="submit" id="submitBtn" class="btn w-100 admin-submit-btn" 
                                style="background: #2A3F54; color: #fff !important; border-radius: 4px; font-size: 14px; font-weight: 600; padding: 10px 15px; border: 0; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fa fa-plus" style="margin-right: 6px; color: #fff !important;"></i> Register Admin Account
                        </button>
                        <style>
                        .admin-submit-btn:hover {
                            background-color: #34495e !important; 
                            color: #fff !important;
                            box-shadow: 0 4px 12px rgba(42, 63, 84, 0.2); 
                            opacity: 0.95;
                        }
                        </style>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Existing Admins List -->
        <div class="col-md-7 col-sm-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 25px; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 12px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">
                        <i class="fa fa-shield" style="margin-right: 8px; color: #4a5f73;"></i>System Administrators
                    </h2>
                    <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                    <div class="table-responsive" style="border: 1px solid #e6e9ed; border-radius: 4px; overflow: visible !important;">
                        <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #fff;">
                                    <th class="column-title" style="padding: 12px 15px; width: 60px;">Photo</th>
                                    <th class="column-title" style="padding: 12px 15px;">Name</th>
                                    <th class="column-title" style="padding: 12px 15px;">Email</th>
                                    <th class="column-title text-center" style="padding: 12px 15px; width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admins ?? [] as $admin)
                                    <tr class="even pointer">
                                        <td style="vertical-align: middle; padding: 10px 15px;">
                                            <img src="{{ $admin->profile_image ? asset('storage/' . $admin->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=f1f5f9&color=475569' }}" 
                                                 alt="Profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
                                        </td>
                                        <td style="vertical-align: middle; padding: 12px 15px; font-weight: 600; color: #333;">{{ $admin->name }}</td>
                                        <td style="vertical-align: middle; padding: 12px 15px; color: #555;">{{ $admin->email }}</td>
                                        <td class="text-center" style="vertical-align: middle; padding: 10px 15px;">
                                            @if(auth()->id() == $admin->id)
                                                <span class="badge text-white" style="background-color: #26b99a; padding: 5px 10px; border-radius: 4px;">You (Admin)</span>
                                            @else
                                                <form action="/admin/manage-admins/{{ $admin->id }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this admin?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs" style="background-color: #d9534f; border-color: #d43f3a; padding: 4px 10px; font-size: 11px; border-radius: 3px;">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 40px; color: #999; font-style: italic;">No admin accounts registered.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="custom-pagination" style="display: flex !important; justify-content: center !important; width: 100% !important; margin-top: 25px; text-align: center !important;">
                        {!! $admins->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile() {
        var preview = document.getElementById('imagePreview');
        var file = document.getElementById('profile_image').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "https://ui-avatars.com/api/?name=New+Admin&background=f1f5f9&color=475569";
        }
    }

    document.getElementById('adminForm').addEventListener('submit', function() {
        var btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Registering...';
    });
</script>
@endsection