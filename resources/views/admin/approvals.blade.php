@extends('panel.layout')

@section('content')
<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">Alumni Membership Approvals</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 3px; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 15px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 8px; margin-bottom: 15px;">
            <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">Pending Review Queue</h2>
            <div class="clearfix"></div>
        </div>
        
        <div class="x_content">
            <table class="table table-striped table-bordered dynamic-table" style="width: 100%; margin-bottom: 0; font-size: 13px;">
                <thead style="background: #2A3F54; color: #fff;">
                    <tr>
                        <th style="width: 8%;">ID</th>
                        <th>Applicant Name</th>
                        <th>Email Address</th>
                        <th>Registration Date</th>
                        <th style="width: 10%;" class="text-center">Status</th>
                        <th style="width: 20%;" class="text-center">Action Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingAlumni as $index => $alumni)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="font-weight: 600; color: #2a3f54;">{{ $alumni->name }}</td>
                            <td>{{ $alumni->email }}</td>
                            <td style="color: #73879C;">{{ $alumni->created_at->format('d M, Y (h:i A)') }}</td>
                            <td class="text-center">
                                <span class="badge" style="background-color: #f39c12; color: #fff; padding: 4px 8px; border-radius: 3px;">Pending</span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.approvals.approve', $alumni->id) }}" method="POST" style="display: inline-block; margin-right: 5px;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-xs" style="border-radius: 3px; background-color: #26b99a; border-color: #169f85; margin: 0; padding: 3px 8px;">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.approvals.reject', $alumni->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs" style="border-radius: 3px; margin: 0; padding: 3px 8px;" onclick="return confirm('Are you sure you want to decline this applicant?');">
                                        <i class="fa fa-times"></i> Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 30px; color: #73879C; font-style: italic; background-color: #f9f9f9;">
                                <i class="fa fa-check-circle" style="font-size: 24px; color: #26b99a; display: block; margin-bottom: 5px;"></i>
                                Excellent! There are no pending account applications requiring verification right now.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection