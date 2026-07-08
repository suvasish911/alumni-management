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
<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Alumni Membership Approvals</h3>
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
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">Pending Review Queue</h2>
                    <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #fff;">
                                    <th class="column-title" style="padding: 10px; width: 5%;">ID</th>
                                    <th class="column-title" style="padding: 10px;">Applicant Name</th>
                                    <th class="column-title" style="padding: 10px;">Student ID</th>
                                    <th class="column-title" style="padding: 10px;">Department</th>
                                    <th class="column-title" style="padding: 10px;">Batch / Session</th>
                                    <th class="column-title" style="padding: 10px;">Email Address</th>
                                    <th class="column-title" style="padding: 10px;">Registration Date</th>
                                    <th class="column-title" style="padding: 10px; width: 8%; text-align: center;">Status</th>
                                    <th class="column-title" style="padding: 10px; width: 18%; text-align: center;">Action Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingAlumni as $index => $alumni)
                                    <tr class="even pointer">
                                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                                        <td style="vertical-align: middle; font-weight: 600; color: #333;">{{ $alumni->name }}</td>
                                        <td style="vertical-align: middle; font-weight: bold; color: #2A3F54;">{{ $alumni->student_id ?? 'N/A' }}</td>
                                        <td style="vertical-align: middle;">
                                            <span class="badge" style="background-color: #34495e; color: #fff; padding: 4px 8px; border-radius: 3px;">{{ $alumni->department ?? 'N/A' }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{ $alumni->batch ?? 'N/A' }} Batch <br>
                                            <small class="text-muted">Session: {{ $alumni->session ?? 'N/A' }}</small>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $alumni->email }}</td>
                                        <td style="vertical-align: middle; color: #73879C;">{{ $alumni->created_at->format('d M, Y (h:i A)') }}</td>
                                        <td style="vertical-align: middle;" class="text-center">
                                            <span class="badge" style="background-color: #f39c12; color: #fff; padding: 4px 8px; border-radius: 3px;">Pending</span>
                                        </td>
                                        <td style="vertical-align: middle;" class="text-center">
                                            <form action="{{ route('admin.approvals.approve', $alumni->id) }}" method="POST" style="display: inline-block; margin-right: 5px;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-xs" style="border-radius: 3px; background-color: #26b99a; border-color: #169f85; margin: 0; padding: 4px 10px;">
                                                    <i class="fa fa-check"></i> Approve
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.approvals.reject', $alumni->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-xs" style="border-radius: 3px; margin: 0; padding: 4px 10px; background-color: #d9534f; border-color: #d43f3a;" onclick="return confirm('Are you sure you want to decline this applicant?');">
                                                    <i class="fa fa-times"></i> Decline
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center" style="padding: 40px; color: #73879C; font-style: italic; background-color: #f9f9f9;">
                                            <i class="fa fa-check-circle" style="font-size: 26px; color: #26b99a; display: block; margin-bottom: 10px;"></i>
                                            Excellent! There are no pending account applications requiring verification right now.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="row" style="margin-top: 20px;">
                        <div class="custom-pagination" style="display: flex !important; justify-content: center !important; width: 100% !important; margin-top: 25px; text-align: center !important;">
                            {!! $pendingAlumni->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection