@extends('panel.layout')

@section('content')
<style>
    .custom-pagination ul.pagination {
        display: flex !important;
        justify-content: center !important;
        margin: 0 auto !important;
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

<div class="container-fluid" style="padding: 10px 20px;"> 
    <div class="page-title" style="margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #2A3F54; font-weight: 500; margin: 0;">Event Management</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 3px; margin-bottom: 15px; padding: 10px 15px;">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
            <div class="x_panel" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #E6F0F3; background: #fff; padding: 20px;">
                
                <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 8px; margin-bottom: 12px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 5px 0 0 0; display: inline-block; line-height: 24px;">
                        <i class="fa fa-calendar" style="color: #26B99A; margin-right: 8px;"></i>All Events <small style="font-size: 12px; display: inline-block; margin-left: 10px;">List of registered events</small>
                    </h2>
                    
                    <div style="float: right; margin-bottom: 0;">
                        <a href="{{ route('admin.events.create') }}" class="btn btn-success btn-sm" style="color:#FFF; background-color:#26B99A; border-color:#169F85; border-radius: 4px; font-weight: 600; padding: 5px 14px; margin: 0;">
                            <i class="fa fa-plus"></i> Create New Event
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content" style="padding-top: 10px;">
                    <div class="table-responsive" style="border: 1px solid #e6e9ed; border-radius: 4px; overflow: visible !important;">
                        <table class="table table-striped jambo_table bulk_action" style="font-size: 13px; margin-bottom: 0;">
                            <thead>
                                <tr class="headings" style="background: #2A3F54; color: #fff;">
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 5%;">ID</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 22%;">Event Name</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 13%;">Category</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Type</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 15%;">Place</th>
                                    <th class="column-title" style="padding: 12px 8px; width: 13%;">Organized By</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 12%;">Fee / Target</th> 
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 15%;">Date</th>
                                    <th class="column-title text-center" style="padding: 12px 8px; width: 13%;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($events) > 0)
                                    @foreach($events as $event)
                                        @php
                                            // Event past or expired check validation
                                            $isExpired = $event->event_date ? \Carbon\Carbon::parse($event->event_date)->isPast() : false;
                                        @endphp
                                        <tr class="even pointer" style="transition: background-color 0.2s ease; {{ $isExpired ? 'background-color: #fdf2f2 !important;' : '' }}">
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px;">{{ $event->id }}</td>
                                            <td style="vertical-align: middle; padding: 12px 8px; font-size: 14px; color: #333;">
                                                <strong>{{ $event->name }}</strong>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px;">
                                                @if($event->category)
                                                    <span class="label label-info" style="font-size: 11px; padding: 3px 8px; border-radius: 2px;">
                                                        {{ $event->category->name }}
                                                    </span>
                                                @else
                                                    <span class="label label-default" style="font-size: 11px; padding: 3px 8px; border-radius: 2px; background-color: #95a5a6;">
                                                        None
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px;">
                                                @if(($event->event_type ?? 'ticketed') === 'fundraiser')
                                                    <span class="label label-success" style="font-size: 11px; padding: 3px 8px; border-radius: 2px; background-color: #26b99a;">Fundraiser</span>
                                                @else
                                                    <span class="label label-primary" style="font-size: 11px; padding: 3px 8px; border-radius: 2px; background-color: #34495e;">Ticketed</span>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $event->place }}</td>
                                            <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $event->organized_by }}</td>
                                            <td class="text-center" style="vertical-align: middle; font-weight: bold; padding: 12px 8px;">
                                                @if($event->amount > 0)
                                                    <span style="color: #E74C3C;">{{ number_format($event->amount, 2) }} TK</span>
                                                @else
                                                    <span class="label label-success" style="font-size: 10px; padding: 3px 6px;">FREE</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 13px;">
                                                {{ $event->event_date ? date('d M, Y (h:i A)', strtotime($event->event_date)) : 'N/A' }}
                                                <div style="margin-top: 4px;">
                                                    @if($isExpired)
                                                        <span class="label label-danger" style="font-size: 10px; padding: 2px 6px; background-color: #d9534f;">Expired / Closed</span>
                                                    @else
                                                        <span class="label label-success" style="font-size: 10px; padding: 2px 6px; background-color: #5cb85c;">Active</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle; padding: 12px 8px; white-space: nowrap;">
                                                <a href="{{ route('admin.events.donors', $event->id) }}" class="btn btn-primary btn-xs" style="border-radius: 3px; padding: 4px 10px; margin-right: 2px; background-color: #34495e; border-color: #2c3e50; display: inline-block; vertical-align: middle;">
                                                    <i class="fa fa-users"></i> Donors/List
                                                </a>

                                                @if($isExpired)
                                                    <button class="btn btn-info btn-xs" style="border-radius: 3px; padding: 4px 10px; margin-right: 2px; opacity: 0.5; display: inline-block; vertical-align: middle;" disabled>
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </button>
                                                    
                                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline-block; margin: 0; padding: 0; vertical-align: middle;" onsubmit="return confirm('This event has expired. Are you sure you want to delete this record?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs" style="background-color: #d9534f; border-color: #d43f3a; padding: 4px 10px; font-size: 11px; border-radius: 3px; margin: 0;">
                                                            <i class="fa fa-trash-o"></i> Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info btn-xs" style="border-radius: 3px; padding: 4px 10px; margin-right: 2px; background-color: #5bc0de; border-color: #46b8da; display: inline-block; vertical-align: middle;">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                    
                                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline-block; margin: 0; padding: 0; vertical-align: middle;" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs" style="background-color: #d9534f; border-color: #d43f3a; padding: 4px 10px; font-size: 11px; border-radius: 3px; margin: 0;">
                                                            <i class="fa fa-trash-o"></i> Delete
                                                        </button> 
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center" style="color: #73879C; padding: 40px; font-size: 14px; font-style: italic; background-color: #f9f9f9;">
                                            <i class="fa fa-calendar-o" style="font-size: 26px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                            No events found in the database.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div> 

                    @if(isset($events) && $events->count() > 0)
                        <div class="custom-pagination" style="display: flex !important; justify-content: center !important; width: 100% !important; margin-top: 25px; text-align: center !important;">
                            {!! $events->links() !!}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection