@extends('panel.layout')

@section('content')
<div class="right_col" role="main" style="min-height: auto; padding: 20px 30px;">
    
    <div class="page-title">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">Edit Donation</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px;">
                
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54;">Update Donation Details</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
        
                    <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST" class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Donor Name <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="donor_name" value="{{ old('donor_name', $donation->donor_name) }}" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Donation Amount (BDT) <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" step="0.01" name="donation_amount" value="{{ old('donation_amount', $donation->donation_amount) }}" required class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Donation Category</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="donation_category_id" class="form-control">
                                    <option value="">Choose Category (Optional)</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('donation_category_id', $donation->donation_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Method <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="payment_method" required class="form-control">
                                    <option value="Cash" {{ old('payment_method', $donation->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="Bank" {{ old('payment_method', $donation->payment_method) == 'Bank' ? 'selected' : '' }}>Bank</option>
                                    <option value="MFS" {{ old('payment_method', $donation->payment_method) == 'MFS' ? 'selected' : '' }}>MFS (Bkash/Nagad)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Received By <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="receiver_name" value="{{ old('receiver_name', $donation->receiver_name) }}" required class="form-control">
                            </div>
                        </div>

                        <div class="ln_solid" style="border-top: 1px solid #e5e5e5; margin-top: 20px; padding-top: 20px;"></div>

                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{ route('admin.donations.index') }}" class="btn btn-primary btn-sm">Cancel</a>
                                <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85;">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection