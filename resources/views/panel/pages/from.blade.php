@extends('panel.layout')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
            <h3 class="mb-0">User Registration</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.form') }}">Form</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            </div>
        </div>
        <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ isset($user) ? route('admin.form.update', $user) : route('admin.form.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))
                            @method('PATCH')
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @if(isset($user))
                                <small class="text-muted">Leave blank to keep the current password.</small>
                            @endif
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- add type field --}}
                        <div class="form-group">
                            <label for="type">User Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="admin" {{ old('type', $user->type ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('type', $user->type ?? '') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if(isset($user) && $user->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->image) }}" width="80" class="rounded" alt="Current Image">
                                </div>
                            @endif
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- end add type field --}}
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection