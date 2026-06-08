@extends('panel.layout')

@section('content')
    
    <div class="page-title">
        <div class="title_left">
            <h3>My Donation History</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Recent Donations <small>All your contributions</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Project Name</th>
                                <th>Amount (BDT)</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($histories as $index => $item)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $item->project->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($item->amount, 2) }}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>
                                        @if($item->status == 'Confirmed')
                                            <span class="label label-success">Confirmed</span>
                                        @elseif($item->status == 'Pending')
                                            <span class="label label-warning">Pending</span>
                                        @else
                                            <span class="label label-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No donation history found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection