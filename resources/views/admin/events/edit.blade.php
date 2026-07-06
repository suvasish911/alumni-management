@extends('panel.layout')

@section('content')
<<<<<<< HEAD

<form action="{{ route('admin.events.update', $events->id) }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
    @csrf
    @method('PUT') <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Event Name <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="name" name="name" value="{{ old('name', $events->name) }}" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Event Category</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="category_name" name="category_name" 
                value="{{ old('category_name', $events->category->name ?? '') }}" 
                list="category_list" class="form-control col-md-7 col-xs-12" 
                placeholder="Type to search or enter a new category">
            
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
            <input type="text" id="place" name="place" value="{{ old('place', $events->place) }}" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organized_by">Organized By <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="organized_by" name="organized_by" value="{{ old('organized_by', $events->organized_by) }}" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">Event Date & Time</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="datetime-local" id="event_date" name="event_date" 
                   value="{{ $events->event_date ? \Illuminate\Support\Carbon::parse($events->event_date)->format('Y-m-d\TH:i') : '' }}" 
                   class="form-control col-md-7 col-xs-12">
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
            <button type="submit" class="btn btn-success">Update</button> </div>
    </div>

</form>
@endsection
=======
<div class="right_col" role="main" style="min-height: auto; padding: 20px 30px;">
    <div class="page-title">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">Edit Event</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px;">
                
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">Update Event Details</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form action="{{ route('admin.events.update', $events->id) }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT') 

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Event Name <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" value="{{ old('name', $events->name) }}" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Event Category</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="category_name" name="category_name" 
                                    value="{{ old('category_name', $events->category->name ?? '') }}" 
                                    list="category_list" class="form-control col-md-7 col-xs-12" 
                                    placeholder="Type to search or enter a new category">
                                
                                <datalist id="category_list">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="place">Venue / Place <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="place" name="place" value="{{ old('place', $events->place) }}" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="organized_by">Organized By <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="organized_by" name="organized_by" value="{{ old('organized_by', $events->organized_by) }}" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">Event Date & Time</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="datetime-local" id="event_date" name="event_date" 
                                       value="{{ $events->event_date ? \Illuminate\Support\Carbon::parse($events->event_date)->format('Y-m-d\TH:i') : '' }}" 
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_type">Event Type <span class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="event_type" id="event_type" class="form-control col-md-7 col-xs-12" required>
                                    <option value="ticketed" {{ old('event_type', $events->event_type) === 'ticketed' ? 'selected' : '' }}>Ticketed Event (Fixed Fee)</option>
                                    <option value="fundraiser" {{ old('event_type', $events->event_type) === 'fundraiser' ? 'selected' : '' }}>Fundraiser (Target Goal Tracking)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" id="amount_label" for="amount">
                                Registration Fee (TK) <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group" style="margin-bottom: 0; display: flex;">
                                    <span class="input-group-addon" style="background: #F2F5F7; font-weight: bold; padding: 6px 12px; border: 1px solid #ccc; border-right: none; border-radius: 4px 0 0 4px; display: flex; align-items: center;">TK</span>
                                    <input type="number" id="amount" name="amount" step="0.01" min="0" 
                                           value="{{ old('amount', $events->amount ?? '0.00') }}" 
                                           class="form-control" style="border-radius: 0 4px 4px 0;" required>
                                </div>
                                <small class="text-muted" id="amount_help_text">Set to 0.00 if this is a free event.</small>
                            </div>
                        </div>

                        <div class="ln_solid" style="border-top: 1px solid #e5e5e5; margin-top: 20px; padding-top: 20px;"></div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-primary btn-sm">Cancel</a>
                                <button type="submit" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85;">Update</button> 
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const eventTypeSelect = document.getElementById('event_type');
        const amountLabel = document.getElementById('amount_label');
        const amountHelpText = document.getElementById('amount_help_text');

        function updateAmountFormLayout() {
            if (eventTypeSelect.value === 'fundraiser') {
                amountLabel.innerHTML = 'Target Fundraising Goal (TK) <span class="text-danger">*</span>';
                amountHelpText.textContent = 'Specify the ultimate collective fund target for this campaign.';
            } else {
                amountLabel.innerHTML = 'Registration Fee (TK) <span class="text-danger">*</span>';
                amountHelpText.textContent = 'Set to 0.00 if this is a free event.';
            }
        }

       
        updateAmountFormLayout();


        eventTypeSelect.addEventListener('change', updateAmountFormLayout);
    });
</script>
@endsection
>>>>>>> 94b6e29863c11c24022e708633b5f8159caf365e
