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
                                        <th class="column-title text-center" style="padding: 12px 8px; width: 17%;">Date</th>
                                        
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
                                                <td class="text-center" style="vertical-align: middle; padding: 12px 8px; color: #555; font-size: 13px;">
                                                    {{ $event->event_date ? date('d M, Y (h:i A)', strtotime($event->event_date)) : 'N/A' }}
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