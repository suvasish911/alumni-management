@extends('panel.layout')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Donations & Giving Dashboard</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 3px; font-weight: 600;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade in" role="alert" style="border-radius: 3px; font-weight: 600;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="x_title">
                    <h2>Active Event Fundraisers <small>Time-sensitive campaigns requiring urgent support</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(count($eventFundraisers) > 0)
                        <div class="row">
                            @foreach($eventFundraisers as $event)
                                @php
                                    $target = $event->amount > 0 ? $event->amount : 1;
                                    $percent = min(round(($event->raised_amount / $target) * 100), 100);
                                @endphp
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="thumbnail" style="border-radius: 4px; padding: 15px; min-height: 250px; position: relative;">
                                        <div class="caption">
                                            <h4 style="font-weight: 700; color: #2A3F54; margin-top: 0;">{{ $event->name }}</h4>
                                            <p style="color: #73879C; font-size: 12px; margin-bottom: 4px;">
                                                <i class="fa fa-map-marker" style="color: #E74C3C;"></i> {{ $event->place }}
                                            </p>
                                            <p style="color: #73879C; font-size: 12px;">
                                                <i class="fa fa-calendar" style="color: #3498DB;"></i> Deadline: {{ $event->event_date ? date('d M, Y', strtotime($event->event_date)) : 'Ongoing' }}
                                            </p>
                                            
                                            <div style="margin-top: 15px;">
                                                <div style="display: flex; justify-content: space-between; font-size: 11px; font-weight: 600; margin-bottom: 4px;">
                                                    <span style="color: #27AE60;">Raised: {{ number_format($event->raised_amount, 2) }} TK</span>
                                                    <span style="color: #7F8C8D;">Goal: {{ number_format($event->amount, 2) }} TK</span>
                                                </div>
                                                <div class="progress" style="height: 8px; margin-bottom: 5px; background-color: #ECEFF1; border-radius: 4px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%; background-color: #26B99A; border-radius: 4px;"></div>
                                                </div>
                                                <div class="text-right" style="font-size: 11px; font-weight: bold; color: #26B99A; margin-bottom: 15px;">
                                                    {{ $percent }}% Complete
                                                </div>
                                            </div>

                                            @if($event->raised_amount >= $event->amount)
                                                <button class="btn btn-success btn-block disabled" style="border-radius: 3px; font-weight: 600;"><i class="fa fa-check-circle"></i> Campaign Goal Met!</button>
                                            @else
                                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#eventModal{{ $event->id }}" style="background-color: #2A3F54; border-color: #1F2E3D; border-radius: 3px; font-weight: 600;">
                                                    <i class="fa fa-heart"></i> Contribute Funds
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content" style="border-radius: 4px;">
                                            <div class="modal-header" style="background-color: #F2F5F7;">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" style="font-weight: 600; font-size: 15px; color: #2A3F54;">Event Fund Donation</h4>
                                            </div>
                                            <form action="{{ route('alumni.donations.storeEvent', $event->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <p style="font-size: 13px;">Campaign: <strong>{{ $event->name }}</strong></p>
                                                    
                                                    <div class="form-group">
                                                        <label style="font-size: 12px; font-weight: 600; color: #555;">Donation Amount (TK) <span style="color:red;">*</span></label>
                                                        <input type="number" name="amount_paid" class="form-control" min="1" step="0.01" required placeholder="e.g. 5000">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px; font-weight: 600; color: #555;">Transaction ID <span style="color:red;">*</span></label>
                                                        <input type="text" name="transaction_id" class="form-control" required placeholder="bKash / Nagad Trx ID">
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background-color: #F9FAFB;">
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm" style="font-weight: 600;">Submit Contribution</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-muted" style="padding: 20px;">No time-limited fundraiser events are active at this moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="x_title">
                    <h2>Continuous Giving & Welfare Funds <small>Ongoing development, charity, and open-ended projects</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(count($ongoingProjects) > 0)
                        <div class="row">
                            @foreach($ongoingProjects as $project)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="thumbnail" style="border-radius: 4px; padding: 15px; background-color: #F8F9FA; border-left: 4px solid #9B59B6; min-height: 140px; position: relative;">
                                        <div class="caption" style="padding: 0;">
                                            <h4 style="font-weight: 700; color: #2A3F54; margin-top: 0; margin-bottom: 8px;">{{ $project->name }}</h4>
                                            <p style="font-size: 12px; color: #73879C; line-height: 1.5; margin-bottom: 20px;">
                                                {{ $project->description ?? 'Contribute anytime to support our lifelong institutional welfare program and student aids.' }}
                                            </p>
                                            
                                            <button class="btn btn-sm btn-block" data-toggle="modal" data-target="#projectModal{{ $project->id }}" style="background-color: #9B59B6; color: white; font-weight: 600; border-radius: 3px; position: absolute; bottom: 12px; left: 0; width: calc(100% - 24px); margin: 0 12px;">
                                                <i class="fa fa-gift"></i> Donate to This Fund
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content" style="border-radius: 4px;">
                                            <div class="modal-header" style="background-color: #F2F5F7;">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" style="font-weight: 600; font-size: 15px; color: #2A3F54;">General Fund Contribution</h4>
                                            </div>
                                            <form action="{{ route('alumni.donations.storeProject', $project->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <p style="font-size: 13px;">Allocating to: <strong style="color: #9B59B6;">{{ $project->name }}</strong></p>
                                                    
                                                    <div class="form-group">
                                                        <label style="font-size: 12px; font-weight: 600; color: #555;">Donation Amount (TK) <span style="color:red;">*</span></label>
                                                        <input type="number" name="donation_amount" class="form-control" min="1" required placeholder="e.g. 1000">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px; font-weight: 600; color: #555;">Payment Gateway Method <span style="color:red;">*</span></label>
                                                        <select name="payment_method" class="form-control" required style="border-radius: 3px;">
                                                            <option value="MFS">Mobile Financial Services (bKash/Nagad)</option>
                                                            <option value="Bank">Direct Bank Transfer</option>
                                                            <option value="Cash">Cash Submission</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px; font-weight: 600; color: #555;">Transaction ID / Reference <span style="color:red;">*</span></label>
                                                        <input type="text" name="transaction_id" class="form-control" required placeholder="Trx ID or Slip Number">
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background-color: #F9FAFB;">
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm" style="background-color: #26B99A; font-weight: 600;">Confirm Donation</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-muted" style="padding: 20px;">No structural donation programs configured at this moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="x_title">
                    <h2>My Fundraising Contributions <small>Timed campaign history</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(isset($myEventDonations) && count($myEventDonations) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th>Campaign</th>
                                        <th>Amount</th>
                                        <th>Transaction ID</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myEventDonations as $registration)
                                        <tr class="even pointer">
                                            <td>{{ $registration->event->name ?? 'Unknown Campaign' }}</td>
                                            <td class="text-success" style="font-weight: 600;">{{ number_format($registration->amount_paid, 2) }} TK</td>
                                            <td><code style="font-size: 11px;">{{ $registration->transaction_id }}</code></td>
                                            <td>
                                                @if($registration->payment_status === 'approved')
                                                    <span class="label label-success" style="padding: 4px 8px;">
                                                        <i class="fa fa-check-circle"></i> Verified & Added
                                                    </span>
                                                @else
                                                    <span class="label label-warning">{{ ucfirst($registration->payment_status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted" style="padding: 15px;">No timed campaign contributions logged.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="x_title">
                    <h2>My General Fund Gifts <small>Continuous ledger history</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(isset($myProjectDonations) && count($myProjectDonations) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th>Fund Category</th>
                                        <th>Amount</th>
                                        <th>Transaction ID</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myProjectDonations as $contribution)
                                        <tr class="even pointer">
                                            <td>{{ $contribution->category->name ?? 'General Fund' }}</td>
                                            <td class="text-success" style="font-weight: 600;">{{ number_format($contribution->donation_amount, 2) }} TK</td>
                                            <td><code style="font-size: 11px;">{{ $contribution->transaction_id }}</code></td>
                                            <td>
                                                @if($contribution->status === 'approved')
                                                    <span class="label label-success" style="padding: 4px 8px;">
                                                        <i class="fa fa-check-circle"></i> Verified & Added
                                                    </span>
                                                @else
                                                    <span class="label label-warning">{{ ucfirst($contribution->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted" style="padding: 15px;">No continuous fund donations logged.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection