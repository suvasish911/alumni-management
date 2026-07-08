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
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">My Registered Events</h3>
            <p class="text-muted small" style="margin-top: 5px;">Track your joined invitations and verification status</p>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 3px; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                        <thead>
                            <tr class="headings" style="background: #2A3F54; color: #fff;">
                                <th class="column-title" style="padding: 10px;">Event Name</th>
                                <th class="column-title" style="padding: 10px;">Type / Category</th>
                                <th class="column-title" style="padding: 10px;">Venue/Place</th>
                                <th class="column-title" style="padding: 10px;">Amount Paid</th>
                                <th class="column-title" style="padding: 10px;">Transaction ID</th>
                                <th class="column-title" style="padding: 10px;">Organized By</th>
                                <th class="column-title" style="padding: 10px;">Event Date</th>
                                <th class="column-title" style="padding: 10px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participatedEvents as $event)
                                <tr class="even pointer">
                                    <td style="vertical-align: middle; font-weight: 600; color: #333;">{{ $event->name }}</td>
                                    <td style="vertical-align: middle;">{{ $event->category?->name ?? 'N/A' }}</td>
                                    
                                    <!-- Fixed Venue Column using $event->place -->
                                    <td style="vertical-align: middle;">{{ $event->place ?? 'N/A' }}</td>
                                    
                                    <td style="vertical-align: middle; font-weight: bold;">
                                        {{ $event->pivot->amount_paid > 0 ? number_format($event->pivot->amount_paid, 2) . ' BDT' : '0.00 BDT (Free)' }}
                                    </td>
                                    <td style="vertical-align: middle; font-family: monospace; color: #e67e22;">
                                        {{ $event->pivot->transaction_id ?? 'N/A' }}
                                    </td>

                                    <!-- Fixed Organizer Column using $event->organized_by -->
                                    <td style="vertical-align: middle; color: #555; font-weight: 500;">
                                        {{ $event->organized_by ?? 'N/A' }}
                                    </td>

                                    <td style="vertical-align: middle; color: #73879C;">
                                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y') : 'N/A' }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        @if($event->pivot->payment_status === 'approved' || $event->pivot->payment_status === 'free')
                                            <span class="badge bg-success" style="background-color: #26b99a; color: #fff; padding: 4px 8px; border-radius: 3px;">Confirmed</span>
                                        @elseif($event->pivot->payment_status === 'pending')
                                            <span class="badge bg-warning" style="background-color: #f39c12; color: #fff; padding: 4px 8px; border-radius: 3px;">Pending Review</span>
                                        @else
                                            <span class="badge bg-danger" style="background-color: #d9534f; color: #fff; padding: 4px 8px; border-radius: 3px;">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding: 40px; color: #73879C; font-style: italic; background-color: #f9f9f9;">
                                        <i class="fa fa-folder-open-o" style="font-size: 26px; color: #ccc; display: block; margin-bottom: 10px;"></i>
                                        You haven't registered for any events yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {!! $participatedEvents->links() !!}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection