<style>
    .custom-pagination .pagination {
        margin-bottom: 0;
        display: flex;
        justify-content: center;
        list-style: none;
        padding-left: 0;
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

@extends('panel.layout')

@section('content')
<div class="" role="main">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Donations & Giving Dashboard</h3>
            <p class="text-muted small" style="margin-top: 5px;">Support active fundraising campaigns and structural welfare development funds</p>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 3px; font-weight: 600; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade in" role="alert" style="border-radius: 3px; font-weight: 600; margin-bottom: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border: 1px solid #e6e9ed; background: #fff; padding: 15px 20px;">
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 7px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: 600; color: #4A5F73; margin: 0; float: left;">Active Event Fundraisers <small style="display: inline-block; margin-left: 10px; font-weight: 400; color: #73879C;">Time-sensitive campaigns requiring urgent support</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="padding: 0;">
                    @if(count($eventFundraisers) > 0)
                        <div class="row" style="display: flex; flex-wrap: wrap;">
                            @foreach($eventFundraisers as $event)
                                @php
                                    $isPastEvent = $event->event_date ? \Carbon\Carbon::parse($event->event_date)->isPast() : false;
                                @endphp

                                @if(!$isPastEvent)
                                    @php
                                        $target = $event->amount > 0 ? $event->amount : 1;
                                        $percent = min(round(($event->raised_amount / $target) * 100), 100);
                                    @endphp
                                    <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 30px; display: flex;">
                                        <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 0; border-radius: 6px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); overflow: hidden; width: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                                            
                                            <div style="background: #2A3F54; padding: 25px 20px; text-align: center; color: #fff; position: relative;">
                                                <span style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.15); padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">
                                                    Fundraiser
                                                </span>
                                                <i class="fa fa-hand-holding-heart" style="font-size: 32px; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                                                <h4 style="margin: 0; font-size: 17px; font-weight: 600; line-height: 1.4; color: #fff;">{{ $event->name }}</h4>
                                            </div>

                                            <div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                                <div>
                                                    <div style="margin-bottom: 12px; font-size: 13px; color: #4a5f73; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        <i class="fa fa-map-marker" style="width: 20px; color: #73879C;"></i> 
                                                        <strong>Venue:</strong> {{ $event->place }}
                                                    </div>
                                                    <div style="margin-bottom: 15px; font-size: 13px; color: #4a5f73;">
                                                        <i class="fa fa-calendar" style="width: 20px; color: #73879C;"></i> 
                                                        <strong>Deadline:</strong> {{ $event->event_date ? date('d M, Y', strtotime($event->event_date)) : 'Ongoing' }}
                                                    </div>
                                                </div>

                                                <div style="background: #fcfcfc; border: 1px solid #f0f2f5; padding: 12px; border-radius: 4px;">
                                                    <div style="display: flex; justify-content: space-between; font-size: 11px; font-weight: 600; margin-bottom: 6px;">
                                                        <span style="color: #2E7D32;">Raised: {{ number_format($event->raised_amount, 2) }} TK</span>
                                                        <span style="color: #73879C;">Goal: {{ number_format($event->amount, 2) }} TK</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px; margin-bottom: 5px; background-color: #ECEFF1; border-radius: 4px; box-shadow: none;">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%; background-color: #26B99A; border-radius: 4px; box-shadow: none;"></div>
                                                    </div>
                                                    <div class="text-right" style="font-size: 11px; font-weight: bold; color: #26B99A;">
                                                        {{ $percent }}% Complete
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="padding: 15px 20px; background: #f9f9f9; border-top: 1px solid #edf0f5;">
                                                @if($event->raised_amount >= $event->amount)
                                                    <button class="btn btn-success btn-block disabled" style="border-radius: 4px; font-weight: 500; font-size: 12px; padding: 7px 14px; margin: 0; background-color: #2E7D32; border-color: #2E7D32; opacity: 0.8;">
                                                        <i class="fa fa-check-circle"></i> Campaign Goal Met!
                                                    </button>
                                                @else
                                                    <button class="btn btn-primary btn-block open-donate-event-modal" 
                                                            style="background-color: #34495e; border-color: #2c3e50; font-size: 12px; padding: 7px 14px; border-radius: 4px; margin: 0; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                                                            data-id="{{ $event->id }}"
                                                            data-name="{{ $event->name }}">
                                                        <i class="fa fa-heart"></i> Contribute Funds
                                                    </button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="custom-pagination text-center" style="margin-top: 10px; margin-bottom: 10px;">
                            {!! $eventFundraisers->appends(['projects' => $ongoingProjects->currentPage()])->links('pagination::bootstrap-4') !!}
                        </div>
                    @else
                        <p class="text-center text-muted" style="padding: 30px; font-style: italic; font-size: 14px; margin: 0;">No time-limited fundraiser events are active at this moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border: 1px solid #e6e9ed; background: #fff; padding: 15px 20px;">
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 7px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: 600; color: #4A5F73; margin: 0; float: left;">Continuous Giving & Welfare Funds <small style="display: inline-block; margin-left: 10px; font-weight: 400; color: #73879C;">Ongoing development, charity, and open-ended projects</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="padding: 0;">
                    @if(count($ongoingProjects) > 0)
                        <div class="row" style="display: flex; flex-wrap: wrap;">
                            @foreach($ongoingProjects as $project)
                                @php
                                    $projectTarget = $project->goal_amount > 0 ? $project->goal_amount : 1;
                                    $projectPercent = min(round(($project->raised_amount / $projectTarget) * 100), 100);
                                @endphp
                                <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 30px; display: flex;">
                                    <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 0; border-radius: 6px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); overflow: hidden; width: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                                        
                                        <div style="background: #2A3F54; padding: 25px 20px; text-align: center; color: #fff; position: relative; border-left: 4px solid #9B59B6;">
                                            <span style="position: absolute; top: 12px; right: 12px; background: #9B59B6; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">
                                                Welfare Fund
                                            </span>
                                            <i class="fa fa-gift" style="font-size: 32px; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                                            <h4 style="margin: 0; font-size: 17px; font-weight: 600; line-height: 1.4; color: #fff;">{{ $project->name }}</h4>
                                        </div>

                                        <div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                            <p style="font-size: 13px; color: #4a5f73; line-height: 1.6; margin-bottom: 15px;">
                                                {{ $project->description ?? 'Contribute anytime to support our lifelong institutional welfare program and student aids.' }}
                                            </p>

                                            <div style="background: #fcfcfc; border: 1px solid #f0f2f5; padding: 12px; border-radius: 4px; margin-top: auto;">
                                                <div style="display: flex; justify-content: space-between; font-size: 11px; font-weight: 600; margin-bottom: 6px;">
                                                    <span style="color: #2E7D32;">Collected: {{ number_format($project->raised_amount, 2) }} BDT</span>
                                                    <span style="color: #73879C;">Target: {{ number_format($project->goal_amount, 2) }} BDT</span>
                                                </div>
                                                <div class="progress" style="height: 6px; margin-bottom: 5px; background-color: #ECEFF1; border-radius: 4px; box-shadow: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $projectPercent }}%; background-color: #26B99A; border-radius: 4px; box-shadow: none;"></div>
                                                </div>
                                                <div class="text-right" style="font-size: 11px; font-weight: bold; color: #26B99A;">
                                                    {{ $projectPercent }}% Funded
                                                </div>
                                            </div>
                                        </div>

                                        <div style="padding: 15px 20px; background: #f9f9f9; border-top: 1px solid #edf0f5; display: flex; align-items: center; justify-content: space-between;">
                                            <div>
                                                <span style="display: block; font-size: 11px; color: #73879C; text-transform: uppercase; font-weight: 500;">Type</span>
                                                <span style="font-size: 13px; font-weight: 700; color: #9B59B6;">Ongoing</span>
                                            </div>

                                            <div>
                                                <button type="button" 
                                                        class="btn btn-sm open-donate-project-modal" 
                                                        style="background-color: #26b99a; border-color: #169f85; color: white; font-size: 12px; padding: 6px 14px; border-radius: 4px; margin: 0; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                                                        data-id="{{ $project->id }}"
                                                        data-name="{{ $project->name }}">
                                                    <i class="fa fa-gift"></i> Donate Now
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="custom-pagination text-center" style="margin-top: 10px; margin-bottom: 10px;">
                            {!! $ongoingProjects->appends(['events' => $eventFundraisers->currentPage()])->links('pagination::bootstrap-4') !!}
                        </div>
                    @else
                        <p class="text-center text-muted" style="padding: 30px; font-style: italic; font-size: 14px; margin: 0;">No structural donation programs configured at this moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dynamicProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="border-radius: 6px; overflow: hidden; border: none;">
                <div class="modal-header" style="background: #2A3F54; color: #fff; padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity: 0.8;"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="projectModalTitle" style="font-size: 15px; font-weight: bold; margin: 0;">Fund Contribution</h4>
                </div>
                <form id="dynamicProjectForm" method="POST" action="">
                    @csrf
                    <div class="modal-body" style="padding: 20px;">
                        <p style="font-size: 13px; margin-bottom: 15px;">Allocating to: <strong id="projectModalAllocatingLabel" style="color: #9B59B6;"></strong></p>
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #555;">Donation Amount (TK) <span style="color:red;">*</span></label>
                            <input type="number" name="donation_amount" class="form-control" min="1" required placeholder="e.g. 1000" style="border-radius: 4px;">
                        </div>
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #555;">Payment Gateway Method <span style="color:red;">*</span></label>
                            <select name="payment_method" class="form-control" required style="border-radius: 4px;">
                                <option value="">-- Select Method --</option>
                                <option value="MFS">Mobile Financial Services (bKash/Nagad)</option>
                                <option value="Bank">Direct Bank Transfer</option>
                                <option value="Cash">Cash Submission</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-size: 12px; font-weight: 600; color: #555;">Transaction ID / Reference <span style="color:red;">*</span></label>
                            <input type="text" name="transaction_id" class="form-control" required placeholder="Trx ID or Slip Number" style="border-radius: 4px;">
                        </div>
                        <input type="hidden" name="donor_name" value="{{ auth()->user()->name ?? 'Alumni Member' }}">
                    </div>
                    <div class="modal-footer" style="background: #f5f7fa; padding: 12px 20px;">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 4px;">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" style="background-color: #26B99A; border-color: #169f85; border-radius: 4px; font-weight: 500;">Confirm Donation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dynamicEventModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="border-radius: 6px; overflow: hidden; border: none;">
                <div class="modal-header" style="background: #2A3F54; color: #fff; padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity: 0.8;"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" style="font-size: 15px; font-weight: bold; margin: 0;">Event Fund Donation</h4>
                </div>
                <form id="dynamicEventForm" method="POST" action="">
                    @csrf
                    <div class="modal-body" style="padding: 20px;">
                        <p style="font-size: 13px; margin-bottom: 15px;">Campaign: <strong id="eventModalAllocatingLabel" class="text-success"></strong></p>
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #555;">Donation Amount (TK) <span style="color:red;">*</span></label>
                            <input type="number" name="amount_paid" class="form-control" min="1" step="0.01" required placeholder="e.g. 5000" style="border-radius: 4px;">
                        </div>

                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #555;">Payment Gateway Method <span style="color:red;">*</span></label>
                            <select name="payment_method" class="form-control" required style="border-radius: 4px;">
                                <option value="">-- Select Method --</option>
                                <option value="MFS">Mobile Financial Services (bKash/Nagad)</option>
                                <option value="Bank">Direct Bank Transfer</option>
                                <option value="Cash">Cash Submission</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-size: 12px; font-weight: 600; color: #555;">Transaction ID / Reference <span style="color:red;">*</span></label>
                            <input type="text" name="transaction_id" class="form-control" required placeholder="Trx ID or Slip Number" style="border-radius: 4px;">
                        </div>
                    </div>
                    <div class="modal-footer" style="background: #f5f7fa; padding: 12px 20px;">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 4px;">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" style="background-color: #26B99A; border-color: #169f85; border-radius: 4px; font-weight: 500;">Submit Contribution</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.open-donate-project-modal').on('click', function(e) {
        e.preventDefault();
        var projectId = $(this).data('id');
        var projectName = $(this).data('name');
        
        var actionUrl = "{{ url('/alumni/donate-project') }}/" + projectId;
        
        $('#dynamicProjectForm').attr('action', actionUrl);
        $('#projectModalTitle').text(projectName + ' Contribution');
        $('#projectModalAllocatingLabel').text(projectName);
        
        $('#dynamicProjectModal').modal('show');
    });

    $('.open-donate-event-modal').on('click', function(e) {
        e.preventDefault();
        var eventId = $(this).data('id');
        var eventName = $(this).data('name');
        
        var actionUrl = "{{ url('/alumni/donate-event') }}/" + eventId;
        
        $('#dynamicEventForm').attr('action', actionUrl);
        $('#eventModalAllocatingLabel').text(eventName);
        
        $('#dynamicEventModal').modal('show');
    });
});
</script>
@endsection