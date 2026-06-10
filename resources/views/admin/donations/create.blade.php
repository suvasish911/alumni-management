@extends('panel.layout')

@section('content')
<div class="right_col" role="main" style="min-height: auto; padding: 20px 30px;">
    <div class="page-title">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">Add New Donation</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px;">
                
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54;">Donation Details</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form action="{{ route('admin.donations.store') }}" method="POST" class="form-horizontal form-label-left">
                        @csrf

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donor_name">Donor Name <span class="required text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="donor_name" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="donation_amount">Donation Amount (BDT) <span class="required text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" step="0.01" name="donation_amount" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Donation Category</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="donation_category_id" class="form-control">
                                    <option value="">Choose Category (Optional)</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_id">
                                Link to Event <small class="text-muted">(Optional)</small>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="event_id" class="form-control">
                                    <option value="">-- None (General Institutional Donation) --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->name }} [{{ ucfirst($event->event_type) }}]
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Method <span class="required text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="payment_method" required class="form-control">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="MFS">MFS (Bkash/Nagad)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="receiver_name">Received By <span class="required text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="receiver_name" required class="form-control" value="{{ Auth::user()->name ?? '' }}">
                            </div>
                        </div>

                        <div class="ln_solid" style="border-top: 1px solid #e5e5e5; margin-top: 20px; padding-top: 20px;"></div>

                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{ route('admin.donations.index') }}" class="btn btn-primary btn-sm">Cancel</a>
                                <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85;">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection