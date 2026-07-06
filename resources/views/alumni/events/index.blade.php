@extends('panel.layout')

@section('content')
<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Available Events</h3>
            <p class="text-muted small" style="margin-top: 5px;">Explore invitations and join upcoming programs</p>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 3px; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert" style="border-radius: 3px; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                        <thead>
                            <tr class="headings" style="background: #2A3F54; color: #fff;">
                                <th class="column-title" style="padding: 10px; width: 20%;">Event Name</th>
                                <th class="column-title" style="padding: 10px;">Type / Category</th>
                                <th class="column-title" style="padding: 10px;">Venue/Place</th>
                                <th class="column-title" style="padding: 10px;">Reg Fee / Target</th>
                                <th class="column-title" style="padding: 10px;">Organized By</th>
                                <th class="column-title" style="padding: 10px;">Event Date</th>
                                <th class="column-title" style="padding: 10px; text-align: center; width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcomingEvents as $event)
                                <tr class="even pointer">
                                    <td style="vertical-align: middle; font-weight: 600; color: #333;">{{ $event->name }}</td>
                                    <td style="vertical-align: middle;">{{ $event->category?->name ?? 'N/A' }}</td>
                                    
                                    <!-- Fixed Venue Column using $event->place -->
                                    <td style="vertical-align: middle;">{{ $event->place ?? 'N/A' }}</td>
                                    
                                    <td style="vertical-align: middle; font-weight: bold; color: #2E7D32;">
                                        {{ $event->amount > 0 ? number_format($event->amount, 2) . ' BDT' : 'Free' }}
                                    </td>

                                    <!-- Fixed Organizer Column using $event->organized_by -->
                                    <td style="vertical-align: middle; color: #555; font-weight: 500;">
                                        {{ $event->organized_by ?? 'N/A' }}
                                    </td>

                                    <td style="vertical-align: middle; color: #73879C;">
                                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y') : 'N/A' }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        @if($event->amount > 0)
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#registerModal{{ $event->id }}" style="background-color: #34495e; border-color: #2c3e50; font-size: 11px; padding: 4px 10px; margin: 0;">
                                                <i class="fa fa-ticket"></i> Register (Paid)
                                            </button>

                                            <div class="modal fade" id="registerModal{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content" style="text-align: left;">
                                                        <div class="modal-header" style="background: #2A3F54; color: #fff;">
                                                            <button type="button" class="close" data-dismiss="modal" style="color:#fff;"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" style="font-size: 15px; font-weight: bold;">Event Payment Gateway</h4>
                                                        </div>
                                                        <form action="{{ route('alumni.events.register', $event->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p><strong>Fee:</strong> {{ number_format($event->amount, 2) }} BDT</p>
                                                                <div class="form-group">
                                                                    <label class="control-label">Transaction ID <span class="text-danger">*</span></label>
                                                                    <input type="text" name="transaction_id" class="form-control" placeholder="Enter bKash/Nagad TxnID" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a;">Submit RSVP</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <form action="{{ route('alumni.events.register', $event->id) }}" method="POST" style="margin: 0;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-xs" style="background-color: #26b99a; border-color: #169f85; font-size: 11px; padding: 4px 10px; margin: 0;">
                                                    <i class="fa fa-check"></i> Join Free Event
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="padding: 40px; color: #73879C; font-style: italic; background-color: #f9f9f9;">
                                        <i class="fa fa-calendar-o" style="font-size: 26px; color: #ccc; display: block; margin-bottom: 10px;"></i>
                                        There are no new upcoming events listed at this time.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {!! $upcomingEvents->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection