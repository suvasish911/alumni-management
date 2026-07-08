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
        @forelse($upcomingEvents as $event)
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
                            <strong>Date:</strong> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y') : 'N/A' }}
                        </div>

                        <div style="margin-bottom: 12px; font-size: 13px; color: #4a5f73;">
                            <i class="fa fa-clock-o" style="width: 20px; color: #73879C;"></i> 
                            <strong>Time:</strong> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('h:i A') : 'N/A' }}
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

                    <div style="padding: 15px 20px; background: #f9f9f9; border-top: 1px solid #edf0f5; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <span style="display: block; font-size: 11px; color: #73879C; text-transform: uppercase; font-weight: 500;">Reg Fee</span>
                            <span style="font-size: 15px; font-weight: 700; color: {{ $event->amount > 0 ? '#2E7D32' : '#26b99a' }};">
                                {{ $event->amount > 0 ? number_format($event->amount, 2) . ' BDT' : 'Free Event' }}
                            </span>
                        </div>

                        <div>
                            @if($event->amount > 0)
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal{{ $event->id }}" style="background-color: #34495e; border-color: #2c3e50; font-size: 12px; padding: 6px 14px; border-radius: 4px; margin: 0; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <i class="fa fa-ticket"></i> Register
                                </button>

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
                                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 4px;">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85; border-radius: 4px; font-weight: 500;">Submit RSVP</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('alumni.events.register', $event->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="background-color: #26b99a; border-color: #169f85; font-size: 12px; padding: 6px 14px; border-radius: 4px; margin: 0; font-weight: 500; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <i class="fa fa-check"></i> Join Now
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 50px 20px; border-radius: 4px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <i class="fa fa-calendar-o" style="font-size: 36px; color: #ccc; display: block; margin-bottom: 15px;"></i>
                    <p style="color: #73879C; font-style: italic; font-size: 14px; margin: 0;">There are no new upcoming events listed at this time.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <div class="custom-pagination">
                {!! $upcomingEvents->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
@endsection