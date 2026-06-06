@extends('panel.layout')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Event Management</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Design <small>Create a new event listing</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        
                        <form action="{{ route('admin.events.store') }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Event Name <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Event Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="category_name" name="category_name" list="category_list" class="form-control col-md-7 col-xs-12" placeholder="Type to search or enter a new category">
                                    
                                    <datalist id="category_list">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->name }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="place">Venue / Place <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="place" name="place" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organized_by">Organized By <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="organized_by" name="organized_by" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">Event Date & Time</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="datetime-local" id="event_date" name="event_date" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">
                                    Registration Fee (TK) <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group" style="margin-bottom: 0;">
                                        <span class="input-group-addon" style="background: #F2F5F7; font-weight: bold;">TK</span>
                                        <input type="number" id="amount" name="amount" step="0.01" min="0" 
                                            value="{{ isset($event) ? $event->amount : old('amount', '0.00') }}" 
                                            class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                    <small class="text-muted">Set to 0.00 if this is a free event.</small>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{ route('admin.events.index') }}" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection