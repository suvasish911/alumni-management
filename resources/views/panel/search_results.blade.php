@extends('panel.layout')

@section('content')
<style>
    .custom-pagination .pagination {
        margin-top: 15px;
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

<div class="">
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Search Results</h3>
            <p class="text-muted small" style="margin-top: 5px;">Showing matching records for: <strong style="color: #2A3F54;">"{{ $query }}"</strong></p>
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

    @if($results['events']->count() > 0)
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-12">
                <h4 style="color: #2A3F54; font-weight: bold; border-bottom: 2px solid #e6e9ed; padding-bottom: 8px;"><i class="fa fa-calendar"></i> Matched Events</h4>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                                    <thead>
                                        <tr class="headings" style="background: #2A3F54; color: #fff;">
                                            <th class="column-title" style="padding: 10px;">Event Name</th>
                                            <th class="column-title" style="padding: 10px;">Category</th>
                                            <th class="column-title" style="padding: 10px;">Date & Time</th>
                                            <th class="column-title" style="padding: 10px;">Venue / Place</th>
                                            <th class="column-title" style="padding: 10px;">Organized By</th>
                                            <th class="column-title" style="padding: 10px;">Ticket Fee</th>
                                            <th class="column-title" style="padding: 10px; text-align: center; width: 10%;">Status</th>
                                            <th class="column-title" style="padding: 10px; text-align: center; width: 18%;">Action Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($results['events'] as $event)
                                            @php
                                                $isExpired = $event->event_date ? \Carbon\Carbon::parse($event->event_date)->isPast() : false;
                                            @endphp
                                            <tr class="even pointer">
                                                <td style="vertical-align: middle; font-weight: 600; color: #333;">{{ $event->name }}</td>
                                                <td style="vertical-align: middle;"><span class="label label-default" style="padding: 4px 8px; background: #e2e8f0; color: #475569; border-radius: 3px;">{{ $event->category?->name ?? 'General' }}</span></td>
                                                <td style="vertical-align: middle;">{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y (h:i A)') : 'N/A' }}</td>
                                                <td style="vertical-align: middle;">{{ $event->place ?? 'N/A' }}</td>
                                                <td style="vertical-align: middle;">{{ $event->organized_by ?? 'N/A' }}</td>
                                                <td style="vertical-align: middle; font-weight: bold; color: #E74C3C;">{{ $event->amount > 0 ? number_format($event->amount, 2) . ' TK' : 'FREE' }}</td>
                                                <td style="vertical-align: middle;" class="text-center">
                                                    @if($isExpired)
                                                        <span class="label label-danger" style="font-size: 11px; background-color: #d9534f;">Expired</span>
                                                    @else
                                                        <span class="label label-success" style="font-size: 11px; background-color: #26b99a;">Active</span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;" class="text-center">
                                                    <div style="display: flex; gap: 4px; justify-content: center;">
                                                        <a href="{{ route('admin.events.donors', $event->id) }}" class="btn btn-primary btn-xs" style="background-color: #34495e; border-color: #2c3e50; margin: 0; padding: 4px 8px;" title="Donors List">
                                                            <i class="fa fa-users"></i> Donor/List
                                                        </a>

                                                        @if($isExpired)
                                                            <button class="btn btn-info btn-xs" style="opacity: 0.5; margin: 0; padding: 4px 8px;" disabled>
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @else
                                                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info btn-xs" style="background-color: #5bc0de; border-color: #46b8da; margin: 0; padding: 4px 8px;">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        @endif

                                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this event record?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs" style="background-color: #d9534f; border-color: #d43f3a; margin: 0; padding: 4px 8px;">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($results['events'] as $event)
                    @php
                        $isExpired = $event->event_date ? \Carbon\Carbon::parse($event->event_date)->isPast() : false;
                    @endphp
                    <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 30px;">
                        <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 0; border-radius: 6px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); overflow: hidden; height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            
                            <div style="background: #2A3F54; padding: 25px 20px; text-align: center; color: #fff; position: relative;">
                                <span style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.15); padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $event->category?->name ?? 'General' }}
                                </span>
                                <i class="fa fa-graduation-cap" style="font-size: 32px; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                                <h4 style="margin: 0; font-size: 17px; font-weight: 600; line-height: 1.4; color: #fff;">{{ $event->name }}</h4>
                            </div>

                            <div style="padding: 20px; flex-grow: 1;">
                                <div style="margin-bottom: 12px; font-size: 13px; color: #4a5f73;">
                                    <i class="fa fa-calendar" style="width: 20px; color: #73879C;"></i> 
                                    <strong>Date:</strong> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y (h:i A)') : 'N/A' }}
                                </div>
                                
                                <div style="margin-bottom: 12px; font-size: 13px; color: #4a5f73; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <i class="fa fa-map-marker" style="width: 20px; color: #73879C;"></i> 
                                    <strong>Venue:</strong> {{ $event->place ?? 'N/A' }}
                                </div>

                                <div style="margin-bottom: 5px; font-size: 13px; color: #4a5f73; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <i class="fa fa-building" style="width: 20px; color: #73879C;"></i> 
                                    <strong>By:</strong> {{ $event->organized_by ?? 'N/A' }}
                                </div>
                            </div>

                            <div style="padding: 15px 20px; background: #f9f9f9; border-top: 1px solid #edf0f5; display: flex; flex-direction: column; gap: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                    <div>
                                        <span style="display: block; font-size: 11px; color: #73879C; text-transform: uppercase; font-weight: 500;">Fee / Target</span>
                                        <span style="font-size: 14px; font-weight: 700; color: #E74C3C;">
                                            {{ $event->amount > 0 ? number_format($event->amount, 2) . ' TK' : 'FREE' }}
                                        </span>
                                    </div>
                                    <div>
                                        @if($isExpired)
                                            <span class="label label-danger" style="font-size: 10px; padding: 3px 6px; background-color: #d9534f; border-radius:2px;">Expired</span>
                                        @else
                                            <span class="label label-success" style="font-size: 10px; padding: 3px 6px; background-color: #5cb85c; border-radius:2px;">Active</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="ln_solid" style="border-top: 1px solid #e5e5e5; margin: 5px 0; width: 100%;"></div>

                                <div style="width: 100%; text-align: right;">
                                    @if($event->amount > 0)
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registerModal{{ $event->id }}" style="background-color: #34495e; border-color: #2c3e50; font-size: 12px; margin: 0;">
                                            <i class="fa fa-ticket"></i> Register
                                        </button>
                                    @else
                                        <form action="{{ route('alumni.events.register', $event->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85; font-size: 12px; margin: 0;">
                                                <i class="fa fa-check"></i> Join Now
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    @if($event->amount > 0)
                        <div class="modal fade" id="registerModal{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content" style="text-align: left; border-radius: 6px; overflow: hidden;">
                                    <div class="modal-header" style="background: #2A3F54; color: #fff; padding: 15px;">
                                        <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity: 0.8;"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" style="font-size: 15px; font-weight: bold; margin: 0;">Event Payment Gateway</h4>
                                    </div>
                                    <form action="{{ route('alumni.events.register', $event->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body" style="padding: 20px;">
                                            <p style="font-size: 14px; margin-bottom: 15px;"><strong>Fee Payment:</strong> <span class="text-success" style="font-weight: bold;">{{ number_format($event->amount, 2) }} BDT</span></p>
                                            <div class="form-group" style="margin-bottom: 0;">
                                                <label class="control-label" style="font-size: 12px; color: #555;">Transaction ID <span class="text-danger">*</span></label>
                                                <input type="text" name="transaction_id" class="form-control" placeholder="Enter bKash/Nagad TxnID" style="border-radius: 4px;" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background: #f5f7fa; padding: 12px 20px;">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85;">Submit RSVP</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    @endif

    @if($results['donations']->count() > 0)
        <div class="row" style="margin-top: 10px; margin-bottom: 15px;">
            <div class="col-md-12">
                <h4 style="color: #2A3F54; font-weight: bold; border-bottom: 2px solid #e6e9ed; padding-bottom: 8px;"><i class="fa fa-heart"></i> Matched Donation Programs</h4>
            </div>
        </div>

        <div class="row">
            @foreach($results['donations'] as $project)
                @php
                    $goal = $project->goal_amount ?? 0;
                    $raised = $project->raised_amount ?? 0;
                    $percentage = $goal > 0 ? ($raised / $goal) * 100 : 0;
                    $percentage = min($percentage, 100);
                @endphp

                @if(auth()->user()->role === 'admin')
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 15px; border-radius: 4px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                            <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 5px; margin-bottom: 10px;">
                                <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">{{ $project->name }}</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <p style="color: #73879C; font-size: 13px; height: 50px; overflow: hidden; margin-bottom: 10px;">
                                    {{ $project->description ?? 'No description provided for this donation project fund.' }}
                                </p>
                                
                                <div style="margin-top: 15px; font-size: 12px; color: #555;">
                                    <div style="float: left;"><strong>Collected:</strong> {{ number_format($raised, 2) }} BDT</div>
                                    <div style="float: right;"><strong>Target:</strong> {{ number_format($goal, 2) }} BDT</div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="progress" style="height: 12px; background-color: #f5f5f5; border-radius: 4px; margin: 8px 0;">
                                    <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $percentage }}%; background-color: #26b99a;"></div>
                                </div>
                                <div style="text-align: right; font-size: 11px; color: #26b99a; font-weight: bold;">
                                    {{ number_format($percentage, 0) }}% Funded
                                </div>

                                <div class="ln_solid" style="border-top: 1px solid #e5e5e5; margin: 15px 0 10px 0;"></div>
                                
                                <div style="margin-top: 10px; display: flex; gap: 5px; width: 100%;">
                                    <a href="{{ route('admin.project.donors', $project->id) }}" class="btn btn-default btn-sm" style="flex: 1; margin: 0; text-align: center;">
                                        <i class="fa fa-list"></i> View Donor Transactions
                                    </a>

                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this project permanently? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 0; padding: 5px 10px; border-radius: 3px;" title="Delete Project">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 30px; display: flex;">
                        <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 0; border-radius: 6px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); overflow: hidden; width: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            
                            <div style="background: #2A3F54; padding: 25px 20px; text-align: center; color: #fff; position: relative; border-left: 4px solid #9B59B6;">
                                <span style="position: absolute; top: 12px; right: 12px; background: #9B59B6; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Fundraiser
                                </span>
                                <i class="fa fa-gift" style="font-size: 32px; opacity: 0.3; display: block; margin-bottom: 10px;"></i>
                                <h4 style="margin: 0; font-size: 17px; font-weight: 600; line-height: 1.4; color: #fff;">{{ $project->name }}</h4>
                            </div>

                            <div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <p style="font-size: 13px; color: #73879C; line-height: 1.6; margin-bottom: 15px; height: 50px; overflow: hidden;">
                                    {{ $project->description ?? 'No description provided for this donation project fund.' }}
                                </p>

                                <div style="background: #fcfcfc; border: 1px solid #f0f2f5; padding: 12px; border-radius: 4px; margin-top: auto;">
                                    <div style="display: flex; justify-content: space-between; font-size: 11px; font-weight: 600; margin-bottom: 6px;">
                                        <span style="color: #2E7D32;">Collected: {{ number_format($raised, 2) }} BDT</span>
                                        <span style="color: #73879C;">Target: {{ number_format($goal, 2) }} BDT</span>
                                    </div>
                                    <div class="progress" style="height: 10px; margin-bottom: 5px; background-color: #f5f5f5; border-radius: 4px; box-shadow: none;">
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $percentage }}%; background-color: #26b99a; border-radius: 4px;"></div>
                                    </div>
                                    <div class="text-right" style="font-size: 11px; font-weight: bold; color: #26b99a;">
                                        {{ number_format($percentage, 0) }}% Funded
                                    </div>
                                </div>
                            </div>

                            <div style="padding: 15px 20px; background: #f9f9f9; border-top: 1px solid #edf0f5;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div>
                                        <span style="display: block; font-size: 11px; color: #73879C; text-transform: uppercase; font-weight: 500;">Type</span>
                                        <span style="font-size: 13px; font-weight: 700; color: #9B59B6;">Ongoing</span>
                                    </div>
                                    <button type="button" class="btn btn-sm open-donate-project-modal" style="background-color: #26b99a; border-color: #169f85; color: white; font-size: 12px; padding: 6px 14px; margin: 0; font-weight: 500;" data-id="{{ $project->id }}" data-name="{{ $project->name }}">
                                        <i class="fa fa-gift"></i> Donate Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @if(auth()->user()->role === 'admin' && $results['users']->count() > 0)
        <div class="row" style="margin-top: 10px; margin-bottom: 15px;">
            <div class="col-md-12">
                <h4 style="color: #2A3F54; font-weight: bold; border-bottom: 2px solid #e6e9ed; padding-bottom: 8px;"><i class="fa fa-users"></i> Matched Alumni Members</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
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
                                        <th class="column-title" style="padding: 10px; width: 10%; text-align: center;">Status</th>
                                        <th class="column-title" style="padding: 10px; width: 22%; text-align: center;">Action Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['users'] as $member)
                                        @php
                                            $isPending = isset($member->status) ? ($member->status === 'pending') : (isset($member->is_approved) && !$member->is_approved);
                                        @endphp
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
                                            <td style="vertical-align: middle;" class="text-center">
                                                @if($isPending)
                                                    <span class="badge" style="background-color: #f39c12; color: #fff; padding: 4px 8px; border-radius: 3px;">Pending</span>
                                                @else
                                                    <span class="badge" style="background-color: #26b99a; color: #fff; padding: 4px 8px; border-radius: 3px;">Approved</span>
                                                @endif
                                            </td>
                                            
                                            <td style="vertical-align: middle;" class="text-center">
                                                @if($isPending)
                                                    <form action="{{ route('admin.approvals.approve', $member->id) }}" method="POST" style="display: inline-block; margin-right: 5px;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-xs" style="border-radius: 3px; background-color: #26b99a; border-color: #169f85; margin: 0; padding: 4px 10px;">
                                                            <i class="fa fa-check"></i> Approve
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.approvals.reject', $member->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs" style="border-radius: 3px; margin: 0; padding: 4px 10px; background-color: #d9534f; border-color: #d43f3a;" onclick="return confirm('Are you sure you want to decline this applicant?');">
                                                            <i class="fa fa-times"></i> Decline
                                                        </button>
                                                    </form>
                                                @else
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
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($results['events']->count() == 0 && $results['donations']->count() == 0 && $results['users']->count() == 0)
        <div class="row" style="margin-top: 40px;">
            <div class="col-md-12 text-center">
                <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 50px 20px; border-radius: 6px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.04);">
                    <i class="fa fa-search" style="font-size: 40px; color: #ccc; display: block; margin-bottom: 15px;"></i>
                    <p style="color: #73879C; font-style: italic; font-size: 15px; margin: 0;">No active events, fundraisers, or members found matching "{{ $query }}".</p>
                </div>
            </div>
        </div>
    @endif

    @if(auth()->user()->role !== 'admin')
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
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-sm" style="background-color: #26B99A; border-color: #169f85;">Confirm Donation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

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
});
</script>
@endsection