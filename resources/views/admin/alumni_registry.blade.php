@extends('panel.layout')

@section('content')
<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">All Members Registry</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">Registered Alumni Directory</h2>
                    <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="font-size: 13px;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #fff;">
                                    <th class="column-title" style="padding: 10px;">Photo</th>
                                    <th class="column-title" style="padding: 10px;">Name</th>
                                    <th class="column-title" style="padding: 10px;">Student ID</th>
                                    <th class="column-title" style="padding: 10px;">Email</th>
                                    <th class="column-title" style="padding: 10px;">Batch</th>
                                    <th class="column-title" style="padding: 10px;">Session</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr class="even pointer">
                                        <td style="vertical-align: middle;">
                                            <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&background=f1f5f9&color=475569' }}" 
                                                 alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
                                        </td>
                                        <td style="vertical-align: middle; font-weight: 600; color: #333;">{{ $member->name }}</td>
                                        <td style="vertical-align: middle;">{{ $member->student_id ?? 'N/A' }}</td>
                                        <td style="vertical-align: middle;">{{ $member->email }}</td>
                                        <td style="vertical-align: middle;"><span class="badge bg-success" style="background-color: #26b99a;">{{ $member->batch ?? 'N/A' }}</span></td>
                                        <td style="vertical-align: middle;">{{ $member->session ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center" style="padding: 30px; color: #999;">No verified alumni members available in the registry.</td>
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