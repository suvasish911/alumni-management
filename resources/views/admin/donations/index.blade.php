@extends('panel.layout')

@section('content')

        <div class="page-title">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">Donation Management</h3>
        </div>
    </div>
    
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
     <div class="row" style="width: 100%; margin: 0; padding: 0;">
    <div class="col-md-12 col-sm-12 col-xs-12" style="width: 100%; padding: 0; float: none;">
        <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; width: 100%; float: left; display: block;"></div>
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; display: inline-block;">All Donations <br><small>List of registered donations</small></h2>
                    <div class="pull-right" style="float: right;">
                        <a href="{{ route('admin.donations.create') }}" class="btn btn-sm text-white" style="background-color: #26b99a; border-color: #169f85;">
                            <i class="fa fa-plus"></i> Create New Donation
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0; width: 100%;">  
                            <thead>
                                <tr class="headings" style="background-color: #34495e; color: #fff;">
                                    <th class="column-title" style="padding: 12px;" width="5%">ID</th>
                                    <th class="column-title" style="padding: 12px;" width="20%">Donor Name</th>
                                    <th class="column-title" style="padding: 12px;" width="15%">Category</th>
                                    <th class="column-title" style="padding: 12px;" width="15%">Amount</th>
                                    <th class="column-title" style="padding: 12px;" width="15%">Payment Method</th>
                                    <th class="column-title" style="padding: 12px;" width="15%">Received By</th>
                                    <th class="column-title" style="padding: 12px;" width="15%">Date</th>
                                    <th class="column-title no-link last" style="padding: 12px; text-align: center;" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $donation)
                                    <tr class="even pointer">
                                        <td class="text-center">{{ $donation->id }}</td>
                                        <td><strong>{{ $donation->donor_name }}</strong></td>
                                        <td><span class="badge bg-secondary">{{ $donation->category->name ?? 'None' }}</span></td>
                                        <td class="text-success"><strong>{{ number_format($donation->donation_amount, 2) }} BDT</strong></td>
                                        <td>{{ $donation->payment_method }}</td>
                                        <td>{{ $donation->receiver_name }}</td>
                                        <td>{{ $donation->created_at->format('d M, Y (h:i A)') }}</td>
                                        
                                        <td class="text-center last">
                                            <a href="{{ route('admin.donations.edit', $donation->id) }}" class="btn btn-info btn-xs" style="padding: 2px 6px;" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted" style="padding: 50px 10px; font-size: 14px;">
                                            No donations found. Click "Create New Donation" to add one!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection