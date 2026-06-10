@extends('panel.layout')

@section('content')
<div class="">
    <div class="page-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500; margin: 0;">Donation Projects Control</h3>
        </div>
        <div class="title_right text-right">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createProjectModal" style="border-radius: 3px; background-color: #26b99a; border-color: #169f85;">
                <i class="fa fa-plus"></i> Create New Project
            </button>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 3px; margin-bottom: 20px; padding: 12px 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert" style="border-radius: 3px; margin-bottom: 20px; padding: 12px 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Error!</strong> Please check the form fields below for invalid data.
        </div>
    @endif

    <div class="row" style="margin-top: 10px;">
        @forelse($projects as $project)
            @php
                $goal = $project->goal_amount ?? 0;
                $raised = $project->raised_amount ?? 0;
                $percentage = $goal > 0 ? ($raised / $goal) * 100 : 0;
                $percentage = min($percentage, 100);
            @endphp
            
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 15px; border-radius: 4px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 5px; margin-bottom: 10px;">
                        <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">{{ $project->name }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p style="color: #73879C; font-size: 13px; height: 50px; overflow: hidden; margin-bottom: 10px;">
                            {{ $project->description ?? 'No description provided for this donation project fund.' }}
                        </p>
                        
                        <div style="margin-top: 15px; font-size: 12px; color: #555;">
                            <div style="float: left;"><strong>Collected:</strong> {{ number_format($raised, 2) }} BDT</div>
                            <div style="float: right;"><strong>Target:</strong> {{ number_format($goal, 2) }} BDT</div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="progress" style="height: 12px; background-color: #f5f5f5; border-radius: 4px; margin: 8px 0;">
                            <div class="progress-bar progress-bar-success" role="progressbar" 
                                 style="width: {{ $percentage }}%; background-color: #26b99a;">
                            </div>
                        </div>
                        <div style="text-align: right; font-size: 11px; color: #26b99a; font-weight: bold;">
                            {{ number_format($percentage, 0) }}% Funded
                        </div>

                        <div class="ln_solid" style="border-top: 1px solid #e5e5e5; margin: 15px 0 10px 0;"></div>
                        
                        <div style="text-align: center;">
                            <a href="{{ route('admin.donations.index', ['project_id' => $project->id]) }}" class="btn btn-default btn-sm" style="width: 100%; border-radius: 3px; color: #2A3F54; font-weight: bold; border-color: #ccc;">
                                <i class="fa fa-list"></i> View Donor Transactions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info text-center" style="padding: 40px 20px; background-color: #ebf5fb; color: #2980b9; border-color: #d4e6f1;">
                    <i class="fa fa-folder-open-o" style="font-size: 28px; display: block; margin-bottom: 10px;"></i>
                    No active donation projects available right now. Click "Create New Project" above to start one!
                </div>
            </div>
        @endforelse
    </div>
</div> <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="border-radius: 4px;">
            <div class="modal-header" style="background: #2A3F54; color: #fff; border-top-left-radius: 4px; border-top-right-radius: 4px;">
                <button type="button" class="close" data-dismiss="modal"><span style="color:#fff;">×</span></button>
                <h4 class="modal-title" style="font-weight: 600; font-size: 16px;"><i class="fa fa-plus-circle"></i> Create New Donation Project</h4>
            </div>
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600; color: #333; margin-bottom: 5px;">Project Name / Fund Title *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g., University Mosque Development Fund" required style="border-radius: 3px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-weight: 600; color: #333; margin-bottom: 5px;">Target Goal Amount (BDT) *</label>
                        <input type="number" name="goal_amount" class="form-control" min="1" placeholder="e.g., 500000" required style="border-radius: 3px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 5px;">
                        <label style="font-weight: 600; color: #333; margin-bottom: 5px;">Description / Purpose Details</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Describe the purpose of this project fund..." style="border-radius: 3px; resize: none;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f7f7f7;">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 3px;">Close</button>
                    <button type="submit" class="btn btn-success btn-sm" style="border-radius: 3px; background-color: #26b99a; border-color: #169f85;">Save Fund Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection