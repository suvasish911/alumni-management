@extends('panel.layout')

@section('content')
<div class="" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="color: #4a5f73; font-size: 22px; font-weight: 500;">
                Donors List <small style="font-size: 14px; color: #73879C;">History for {{ $project->name }}</small>
            </h3>
        </div>
        <div class="title_right text-right" style="padding-top: 5px;">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-default btn-sm" style="border-radius: 3px; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <i class="fa fa-arrow-left"></i> Back to Projects
            </a>
        </div>
    </div>
    
    <div class="clearfix"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 3px; font-weight: 600;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row" style="width: 100%; margin: 0; padding: 0;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="width: 100%; padding: 0; float: none;">
            <div class="x_panel" style="background: #fff; border: 1px solid #e6e9ed; padding: 20px; border-radius: 4px; width: 100%; float: left; display: block; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                
                <div class="x_title" style="border-bottom: 2px solid #E6E9ED; padding-bottom: 10px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: bold; color: #2a3f54; display: inline-block;">
                        Contributions Ledger <br>
                
                        <small style="font-size: 12px; color: #73879C;">Total Raised for this fund: <strong>{{ number_format($totalRaisedDynamic ?? 0, 2) }} TK</strong></small>
                    </h2>
                    <div class="clearfix"></div>
                </div>


                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered" style="margin-bottom: 0; width: 100%; border-collapse: separate; border-spacing: 0 10px; background-color: transparent;">
                            <thead>
                                <tr class="headings" style="background-color: #34495e; color: #fff; font-size: 13px;">
                                    <th style="padding: 15px; border: none; text-align: center;" width="8%">ID</th>
                                    <th style="padding: 15px; border: none;" width="32%">Donor Name</th>
                                    <th style="padding: 15px; border: none; text-align: right;" width="20%">Amount Donated</th>
                                    <th style="padding: 15px; border: none; text-align: center;" width="20%">Payment Method</th>
                                    <th style="padding: 15px; border: none; text-align: center;" width="20%">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donors as $donor)
                                <tr style="background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 10px; border-radius: 4px;">
                                    <!-- 1. Transaction ID -->
                                    <td class="text-center" style="padding: 15px; vertical-align: middle; border: none; color: #73879C;">
                                        {{ $donor->id }}
                                    </td>
                                    

                                    <td style="padding: 15px; vertical-align: middle; border: none;">
                                        <span style="font-size: 14px; font-weight: 500; color: #2A3F54;">{{ $donor->donor_name }}</span>
                                    </td>
                                    

                                    <td style="padding: 15px; vertical-align: middle; border: none; text-align: right;">
                                        <strong style="color: #27AE60; font-size: 14px;">{{ number_format($donor->donation_amount, 2) }} TK</strong>
                                    </td>
                                    

                                    <td class="text-center" style="padding: 15px; vertical-align: middle; border: none;">
                                        <span class="label" style="background-color: #34495E; color: #fff; padding: 4px 8px; border-radius: 2px; font-size: 11px; font-weight: bold; text-transform: uppercase;">
                                            {{ $donor->payment_method }}
                                        </span>
                                    </td>
                                    

                                    <td class="text-center" style="padding: 15px; vertical-align: middle; border: none; font-size: 12px; color: #73879C; line-height: 1.4;">
                                        {{ $donor->created_at->format('d M, Y') }}<br>
                                        <small style="color: #95A5A6;">({{ $donor->created_at->format('h:i A') }})</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted" style="padding: 50px 10px; background-color: #fff; border-radius: 4px;">
                                        <i class="fa fa-info-circle" style="font-size: 24px; color: #BDC3C7; margin-bottom: 10px; display: block;"></i>
                                        No alumni contributions have been logged for this specific fund project yet.
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