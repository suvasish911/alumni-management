@extends('panel.layout')

@section('content')
<div class="" role="main">
    <div class="container"> <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                
                <div class="x_panel" style="box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 4px; padding: 15px 20px;">
                    
                    <div class="x_title" style="border-bottom: 2px solid #E6F0F2; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 600; color: #2A3F54; margin: 0;">
                            All Events <small style="display: inline-block; margin-left: 10px;">List of registered events</small>
                        </h2>
                        <div class="nav navbar-right font-panel-options">
                            <a href="/admin/events/create" class="btn btn-success btn-sm" style="color:#FFF; border-radius: 3px; font-weight: 600; padding: 6px 12px;">
                                <i class="fa fa-plus"></i> Create New Event
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive"> <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 8%;">ID</th>
                                        <th class="column-title" style="padding: 12px 8px; width: 25%;">Event Name</th>
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 15%;">Category</th>
                                        <th class="column-title" style="padding: 12px 8px; width: 18%;">Place</th>
                                        <th class="column-title" style="padding: 12px 8px; width: 15%;">Organized By</th>
                                        <th class="column-title text-center" style="padding: 12px 8px;">Reg Fee</th> 
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 17%;">Date</th>
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 15%;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(count($events) > 0)
                                        @foreach($events as $event)
                                            <tr class="even pointer" style="transition: background-color 0.2s ease;">
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
                                                <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $event->place }}</td>
                                                <td style="vertical-align: middle; padding: 12px 8px; color: #555;">{{ $event->organized_by }}</td>
                                                <td class="text-center" style="vertical-align: middle; font-weight: bold;">
                                                    @if($event->amount > 0)
                                                        <span style="color: #E74C3C;">{{ number_format($event->amount, 2) }} TK</span>
                                                    @else
                                                        <span class="label label-success" style="font-size: 10px;">FREE</span>
                                                    @endif
                                                </td>
                                                <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 13px;">
                                                    {{ $event->event_date ? date('d M, Y (h:i A)', strtotime($event->event_date)) : 'N/A' }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle; padding: 12px 8px; white-space: nowrap;">
                                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info btn-xs" style="border-radius: 3px; padding: 4px 8px; margin-right: 2px;">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>

                                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs" style="border-radius: 3px; padding: 4px 8px;">
                                                            <i class="fa fa-trash-o"></i> Delete
                                                        </button> 
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center" style="color: #7f8c8d; padding: 40px 20px; font-size: 15px;">
                                                <i class="fa fa-calendar-o" style="font-size: 24px; display: block; margin-bottom: 10px; color: #bdc3c7;"></i>
                                                No events found in the database.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection