@extends('panel.layout')

@section('content')
<div class="" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Error!</strong> {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Notice:</strong> {{ session('error') }}
                </div>
            @endif

            <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.04); border-radius: 4px; padding: 15px 20px;">
                <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; font-weight: 600; color: #2A3F54; margin: 0;">
                        Available Events <small>Explore invitations and join upcoming programs</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #FFF;">
                                    <th class="column-title" style="padding: 12px 8px; width: 22%;">Event Name</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 13%;">Type / Category</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 18%;">Venue/Place</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 15%;">Reg Fee / Target</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 12%;">Organized By</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Event Date</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($upcomingEvents) > 0)
                                    @foreach($upcomingEvents as $events)
                                        <tr>
                                            <td style="vertical-align: middle; padding: 12px 8px; font-weight: 600; color: #333;">{{ $events->name }}</td>
                                            <td style="vertical-align: middle; padding: 12px 8px;">
                                                <span class="label label-info" style="font-size: 10px; padding: 2px 5px; margin-right: 2px;">{{ $events->category->name ?? 'General' }}</span>
                                                <span class="label" style="font-size: 10px; padding: 2px 5px; background-color: {{ ($events->event_type ?? 'ticketed') === 'ticketed' ? '#34495E' : '#9B59B6' }};">
                                                    {{ ucfirst($events->event_type ?? 'ticketed') }}
                                                </span>
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;"><i class="fa fa-map-marker" style="color: #E74C3C; margin-right: 5px;"></i> {{ $events->place }}</td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; font-size: 12px;">
                                                @if(($events->event_type ?? 'ticketed') === 'ticketed')
                                                    @if($events->amount > 0)
                                                        <span style="font-weight: bold; color: #E74C3C;">{{ number_format($events->amount, 2) }} TK</span>
                                                    @else
                                                        <span class="label label-success" style="font-size: 10px; padding: 2px 5px;">FREE</span>
                                                    @endif
                                                @else
                                                    <div style="font-weight: bold; color: #8E44AD; margin-bottom: 2px;">Goal: {{ number_format($events->amount, 2) }} TK</div>
                                                    <div style="font-size: 10px; color: #555;">Raised: {{ number_format($events->raised_amount ?? 0, 2) }} TK</div>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $events->organized_by }}</td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 11px;">
                                                {{ $events->event_date ? date('d M, Y (h:i A)', strtotime($events->event_date)) : 'TBD' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 8px;">
                                                @if(($events->event_type ?? 'ticketed') === 'fundraiser' && ($events->raised_amount ?? 0) >= $events->amount)
                                                    <button type="button" class="btn btn-success btn-xs" disabled style="border-radius: 3px; font-weight: 600; margin: 0; padding: 5px 10px; cursor: not-allowed; opacity: 0.85;">
                                                        <i class="fa fa-check-circle"></i> Goal Achieved!
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#registerModal{{ $events->id }}" style="border-radius: 3px; font-weight: 600; background-color: #34495E; border-color: #2C3E50; margin: 0; padding: 5px 10px;">
                                                        <i class="fa fa-plus-circle"></i> {{ ($events->event_type ?? 'ticketed') === 'ticketed' ? 'Join Event' : 'Donate' }}
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>

                                        @unless(($events->event_type ?? 'ticketed') === 'fundraiser' && ($events->raised_amount ?? 0) >= $events->amount)
                                        <div class="modal fade" id="registerModal{{ $events->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content" style="border-radius: 4px;">
                                                    <div class="modal-header" style="background-color: #F2F5F7;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title" style="font-weight: 600; color: #2A3F54; font-size: 15px;">
                                                            {{ ($events->event_type ?? 'ticketed') === 'ticketed' ? 'Confirm RSVP' : 'Contribute Funds' }}
                                                        </h4>
                                                    </div>
                                                    <form action="{{ route('alumni.events.register', $events->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body text-left">
                                                            <p style="font-size: 13px; color: #333; margin-bottom: 10px;">
                                                                Are you sure you want to participate in <strong>{{ $events->name }}</strong>?
                                                            </p>
                                                            
                                                            @if(($events->event_type ?? 'ticketed') === 'fundraiser')
                                                                <div class="form-group" style="margin-top: 10px;">
                                                                    <label style="font-size: 12px; color: #555; font-weight: 600;">Contribution Amount (TK) <span style="color: red;">*</span></label>
                                                                    <input type="number" name="amount_paid" class="form-control" min="1" step="0.01" placeholder="Enter amount to donate" style="border-radius: 3px;" required>
                                                                </div>
                                                            @else
                                                                <p style="font-size: 13px; color: #333; margin-bottom: 15px;">
                                                                    Registration Fee: 
                                                                    <strong>
                                                                        @if($events->amount > 0)
                                                                            <span style="color: #E74C3C;">{{ number_format($events->amount, 2) }} TK</span>
                                                                        @else
                                                                            <span style="color: #26B99A;">Free Event</span>
                                                                        @endif
                                                                    </strong>
                                                                </p>
                                                            @endif

                                                            @if((($events->event_type ?? 'ticketed') === 'ticketed' && $events->amount > 0) || ($events->event_type ?? 'ticketed') === 'fundraiser')
                                                                <div class="form-group" style="margin-top: 12px;">
                                                                    <label for="transaction_id" style="font-size: 12px; color: #555; font-weight: 600;">Transaction ID <span style="color: red;">*</span></label>
                                                                    <input type="text" name="transaction_id" class="form-control" placeholder="e.g. bKash / Nagad TrxID" style="border-radius: 3px;" required>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer" style="background-color: #F9FAFB;">
                                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 3px;">Cancel</button>
                                                            <button type="submit" class="btn btn-success btn-sm" style="font-weight: 600; border-radius: 3px;">
                                                                {{ ($events->event_type ?? 'ticketed') === 'ticketed' ? 'Confirm & Register' : 'Submit Donation' }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #95a5a6; padding: 30px 20px;">
                                            <i class="fa fa-calendar-minus-o" style="font-size: 24px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                            There are no new upcoming events listed at this time.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right" style="margin-top: 15px;">
                        {!! $upcomingEvents->appends(request()->except('upcoming_page'))->links() !!}
                    </div>
                </div>
            </div>

            <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.04); border-radius: 4px; padding: 15px 20px; margin-top: 25px;">
                <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; font-weight: 600; color: #2A3F54; margin: 0;">
                        My Registered Events <small>Track your joined invitations and status indicators</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #34495E; color: #FFF;">
                                    <th class="column-title" style="padding: 12px 8px; width: 25%;">Event Name</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 13%;">Type / Category</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 17%;">Venue/Place</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 13%;">Amount Paid</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 15%;">Transaction ID</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Event Date</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($participatedEvents) > 0)
                                    @foreach($participatedEvents as $pEvent)
                                        <tr>
                                            <td style="vertical-align: middle; padding: 12px 8px; font-weight: 600; color: #333;">{{ $pEvent->name }}</td>
                                            <td style="vertical-align: middle; padding: 12px 8px;">
                                                <span class="label label-primary" style="font-size: 10px; padding: 2px 5px; margin-right:2px;">{{ $pEvent->category->name ?? 'General' }}</span>
                                                <span class="label label-default" style="font-size: 10px; padding: 2px 5px;">{{ ucfirst($pEvent->event_type ?? 'ticketed') }}</span>
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;"><i class="fa fa-map-marker" style="color: #E74C3C; margin-right: 5px;"></i> {{ $pEvent->place }}</td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; font-weight: bold; color: #333;">
                                                {{ number_format($pEvent->pivot->amount_paid, 2) }} TK
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px;">
                                                @if($pEvent->pivot->transaction_id)
                                                    <code>{{ $pEvent->pivot->transaction_id }}</code>
                                                @else
                                                    <span class="text-muted" style="font-size: 11px;">N/A (Free)</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 11px;">
                                                {{ $pEvent->event_date ? date('d M, Y (h:i A)', strtotime($pEvent->event_date)) : 'TBD' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 8px;">
                                                @if($pEvent->pivot->payment_status == 'pending')
                                                    <span class="label label-warning" style="font-size: 11px; padding: 4px 8px; display: inline-block; width: 100px; text-align: center;">
                                                        <i class="fa fa-spinner fa-spin"></i> Pending
                                                    </span>
                                                @elseif($pEvent->pivot->payment_status == 'rejected')
                                                    <span class="label label-danger" style="font-size: 11px; padding: 4px 8px; display: inline-block; width: 100px; text-align: center;">
                                                        <i class="fa fa-times-circle"></i> Rejected
                                                    </span>
                                                @else
                                                    <span class="label label-success" style="background-color: #26B99A; font-size: 11px; padding: 4px 8px; display: inline-block; width: 100px; text-align: center;">
                                                        <i class="fa fa-check-circle"></i> Confirmed
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #95a5a6; padding: 30px 20px;">
                                            <i class="fa fa-folder-open-o" style="font-size: 24px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                            You haven't registered for any events yet.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right" style="margin-top: 15px;">
                        {!! $participatedEvents->appends(request()->except('participated_page'))->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection