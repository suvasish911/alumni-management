@extends('panel.layout')

@section('content')
<div class="right_col" role="main" style="min-height: auto; padding: 20px 30px;">
    
    <div class="page-title">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">Donation Projects</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row" style="margin-top: 20px;">
        @forelse($projects as $project)
            @php
                $percentage = $project->goal_amount > 0 ? ($project->raised_amount / $project->goal_amount) * 100 : 0;
                $percentage = min($percentage, 100);
            @endphp
            
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 15px; border-radius: 4px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <div class="x_title" style="border-bottom: 1px solid #E6E9ED; padding-bottom: 5px; margin-bottom: 10px;">
                        <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; margin: 0;">{{ $project->name }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- ডেসক্রিপশন বাদ দিয়ে শুধু সিম্পল টেক্সট -->
                        <p style="color: #73879C; font-size: 13px; height: 50px;">
                            Help us reach our goal by contributing to this project.
                        </p>
                        
                        <div style="margin-top: 15px; font-size: 12px; color: #555;">
                            <div style="float: left;"><strong>Raised:</strong> {{ number_format($project->raised_amount, 2) }} BDT</div>
                            <div style="float: right;"><strong>Goal:</strong> {{ number_format($project->goal_amount, 2) }} BDT</div>
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
                            <a href="{{ route('admin.donations.create', ['project_id' => $project->id]) }}" class="btn btn-success btn-sm" style="background-color: #26b99a; border-color: #169f85; width: 100%; border-radius: 3px;">
                                <i class="fa fa-heart"></i> Donate Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info text-center" style="padding: 20px;">No active donation projects available right now.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection