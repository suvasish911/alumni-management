@extends('panel.layout')

@section('content')

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
                value="{{ old('category_name', $event->category->name ?? '') }}" 
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

    <div class="ln_solid"></div>
    
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a href="{{ route('admin.events.index') }}" class="btn btn-primary">Cancel</a>
            <button type="submit" class="btn btn-success">Update</button> </div>
    </div>

</form>
@endsection
