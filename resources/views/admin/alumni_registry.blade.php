@extends('panel.layout')

@section('content')
<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">All Members Registry</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 3px; margin-top: 10px; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">Registered Alumni Directory</h2>
                    <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #fff;">
                                    <th class="column-title" style="padding: 10px; width: 6%;">Photo</th>
                                    <th class="column-title" style="padding: 10px;">Name</th>
                                    <th class="column-title" style="padding: 10px;">Student ID</th>
                                    <th class="column-title" style="padding: 10px;">Department</th>
                                    <th class="column-title" style="padding: 10px;">Batch / Session</th>
                                    <th class="column-title" style="padding: 10px;">Email Address</th>
                                    <th class="column-title" style="padding: 10px; width: 22%; text-align: center;">Action Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr class="even pointer">
                                        <td style="vertical-align: middle;">
                                            <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&background=f1f5f9&color=475569' }}" 
                                                 alt="Profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;"
                                                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=f1f5f9&color=475569';">
                                        </td>
                                        <td style="vertical-align: middle; font-weight: 600; color: #333;">{{ $member->name }}</td>
                                        <td style="vertical-align: middle; font-weight: bold; color: #2A3F54;">{{ $member->student_id ?? 'N/A' }}</td>
                                        <td style="vertical-align: middle;">
                                            <span class="badge" style="background-color: #34495e; color: #fff; padding: 4px 8px; border-radius: 3px;">{{ $member->department ?? 'N/A' }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{ $member->batch ?? 'N/A' }} Batch <br>
                                            <small class="text-muted">Session: {{ $member->session ?? 'N/A' }}</small>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $member->email }}</td>
                                        
                                        <td style="vertical-align: middle;" class="text-center">
                                            <form action="/admin/make-admin/{{ $member->id }}" method="POST" style="display: inline-block; margin-right: 5px;" onsubmit="return confirm('Promote this alumni to Administrator?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-xs" style="border-radius: 3px; background-color: #26b99a; border-color: #169f85; margin: 0; padding: 4px 10px;">
                                                    <i class="fa fa-user-shield"></i> Make Admin
                                                </button>
                                            </form>

                                            <form action="/admin/alumni-registry/{{ $member->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to completely remove this member from the system?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs" style="border-radius: 3px; margin: 0; padding: 4px 10px; background-color: #d9534f; border-color: #d43f3a;">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center" style="padding: 40px; color: #73879C; font-style: italic; background-color: #f9f9f9;">
                                            <i class="fa fa-info-circle" style="font-size: 26px; color: #34495e; display: block; margin-bottom: 10px;"></i>
                                            No registered alumni members available in the directory.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection