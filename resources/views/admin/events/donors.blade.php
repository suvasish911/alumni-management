@extends('panel.layout')

@section('content')
<div class="" role="main">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 3px; margin-bottom: 15px; background-color: #26B99A; color: #fff; border: none; padding: 10px 15px;">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 4px; padding: 15px 20px; background: #fff; border: 1px solid #e6e9ed; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <div>
                            <span class="label {{ $events->event_type === 'fundraiser' ? 'label-success' : 'label-primary' }}" style="text-transform: uppercase; font-size: 10px; padding: 4px 8px;">
                                {{ $events->event_type }}
                            </span>
                            <h2 style="font-size: 22px; font-weight: 600; color: #2A3F54; margin: 5px 0 0 0;">{{ $events->name }}</h2>
                            <p class="text-muted" style="margin: 5px 0 0 0;">
                                <i class="fa fa-map-marker"></i> {{ $events->place }} | <i class="fa fa-building"></i> Organized By: {{ $events->organized_by }}
                            </p>
                        </div>
                        <div style="text-align: right;">
                            <h3 style="margin: 0; font-weight: bold; color: #2A3F54;">
                                {{ $events->event_type === 'fundraiser' ? 'Target Goal:' : 'Ticket Price:' }}
                                <span style="color: #E74C3C;">{{ number_format($events->amount, 2) }} TK</span>
                            </h3>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-default btn-sm" style="margin-top: 8px; border-radius: 3px;">
                                <i class="fa fa-arrow-left"></i> Back to Events
                            </a>
                        </div>
                    </div>
                </div>

                <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 4px; padding: 15px 20px; background: #fff; border: 1px solid #e6e9ed;">
                    <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 16px; font-weight: 600; color: #2A3F54; margin: 0;">
                            {{ $events->event_type === 'fundraiser' ? 'Donors & Contributors Record' : 'Registered Attendees Roster' }}
                        </h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive"> 
                            <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 5%;">ID</th>
                                        <th class="column-title" style="padding: 12px 8px; width: 25%;">Participant Name</th>
                                        <th class="column-title" style="padding: 12px 8px; width: 18%;">Phone</th>
                                        <th class="column-title" style="padding: 12px 8px; width: 20%;">Email</th>
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 15%;">Transaction ID</th>
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Amount Provided</th> 
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 15%;">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(count($registrations) > 0)
                                        @foreach($registrations as $reg)
                                            @php
                                                $statusValue = strtolower(trim($reg->payment_status));
                                            @endphp
                                            <tr class="even pointer" style="vertical-align: middle;">
                                                <td class="text-center" style="vertical-align: middle; padding: 12px 8px;">{{ $reg->id }}</td>
                                                <td style="vertical-align: middle; padding: 12px 8px; font-size: 14px; color: #333;">
                                                    <strong>{{ $reg->name }}</strong>
                                                </td>
                                                <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $reg->phone }}</td>
                                                <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $reg->email ?? 'N/A' }}</td>
                                                <td class="text-center" style="vertical-align: middle; padding: 12px 8px; font-family: monospace; font-weight: bold; color: #2c3e50;">
                                                    {{ $reg->transaction_id ?? 'CASH/DIRECT' }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle; font-weight: bold; color: #27ae60;">
                                                    {{ number_format($reg->amount_paid, 2) }} TK
                                                </td>
                                                <td class="text-center" style="vertical-align: middle; padding: 12px 8px;">
                                                    @if($statusValue === 'approved')
                                                        <span class="label label-success" style="font-size: 11px; padding: 4px 8px; background-color: #26B99A;">Approved</span>
                                                    @else
                                                        <form action="{{ route('admin.events.approve', $reg->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-warning btn-xs" style="border-radius: 3px; padding: 3px 8px; font-weight: 600; color: #fff; background-color: #f0ad4e; border-color: #eea236;" onclick="return confirm('Confirm verification and approve this transaction?');">
                                                                Approve ?
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center" style="color: #7f8c8d; padding: 40px 20px; font-size: 15px;">
                                                <i class="fa fa-user-times" style="font-size: 24px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                                No registration records or transactions found for this event yet.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection