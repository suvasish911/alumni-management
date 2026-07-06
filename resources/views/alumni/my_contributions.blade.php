@extends('panel.layout')

@section('content')
<div class="" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="color: #2A3F54; font-weight: 600;">My Contributions Ledger</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
            <div class="x_panel" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #E6F0F3;">
                <div class="x_title" style="border-bottom: 2px solid #E6F0F3; padding-bottom: 10px;">
                    <h2><i class="fa fa-history" style="color: #26B99A; margin-right: 8px;"></i>My Fundraising Contributions <small style="font-size: 12px;">Timed campaign history ledger</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="padding-top: 10px;">
                    @if(isset($myEventDonations) && count($myEventDonations) > 0)
                        <div class="table-responsive" style="border-radius: 4px; overflow: hidden; border: 1px solid #EAECEE;">
                            <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                                <thead>
                                    <tr class="headings" style="background: #2A3F54;">
                                        <th class="column-title" style="padding: 12px 8px;">Campaign Name</th>
                                        <th class="column-title" style="padding: 12px 8px;">Amount Paid</th>
                                        <th class="column-title" style="padding: 12px 8px;">Transaction ID / Ref</th>
                                        <th class="column-title" style="padding: 12px 8px;">Verification Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myEventDonations as $registration)
                                        <tr class="even pointer" style="transition: background 0.2s;">
                                            <td style="padding: 12px 8px; vertical-align: middle; font-weight: 500; color: #333;">{{ $registration->event->name ?? 'Unknown Campaign' }}</td>
                                            <td class="text-success" style="padding: 12px 8px; vertical-align: middle; font-weight: 700; font-size: 14px;">{{ number_format($registration->amount_paid, 2) }} TK</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;"><code style="font-size: 12px; color: #E74C3C; background: #FDEDEC; padding: 3px 6px; border-radius: 3px; font-weight: 600;">{{ $registration->transaction_id }}</code></td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">
                                                @if($registration->payment_status === 'approved')
                                                    <span class="label label-success" style="padding: 5px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; display: inline-block;">
                                                        <i class="fa fa-check-circle"></i> Verified &amp; Settled
                                                    </span>
                                                @else
                                                    <span class="label" style="padding: 5px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; display: inline-block; background-color: #F39C12; color: #fff;">
                                                        <i class="fa fa-clock-o"></i> {{ ucfirst($registration->payment_status) }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted" style="padding: 30px 15px; background: #FAFBFB; border-radius: 6px; border: 1px dashed #DCE4EC;">
                            <i class="fa fa-sticky-note-o" style="font-size: 32px; color: #BDC3C7; margin-bottom: 10px;"></i>
                            <p style="font-size: 13px; margin-bottom: 0;">No timed campaign contributions logged yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #E6F0F3;">
                <div class="x_title" style="border-bottom: 2px solid #E6F0F3; padding-bottom: 10px;">
                    <h2><i class="fa fa-history" style="color: #9B59B6; margin-right: 8px;"></i>My General Fund Gifts <small style="font-size: 12px;">Continuous ledger history history</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="padding-top: 10px;">
                    @if(isset($myProjectDonations) && count($myProjectDonations) > 0)
                        <div class="table-responsive" style="border-radius: 4px; overflow: hidden; border: 1px solid #EAECEE;">
                            <table class="table table-striped jambo_table bulk_action" style="margin-bottom: 0;">
                                <thead>
                                    <tr class="headings" style="background: #2A3F54;">
                                        <th class="column-title" style="padding: 12px 8px;">Fund Category</th>
                                        <th class="column-title" style="padding: 12px 8px;">Amount Contributed</th>
                                        <th class="column-title" style="padding: 12px 8px;">Transaction ID / Ref</th>
                                        <th class="column-title" style="padding: 12px 8px;">Verification Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myProjectDonations as $contribution)
                                        <tr class="even pointer" style="transition: background 0.2s;">
                                            <td style="padding: 12px 8px; vertical-align: middle; font-weight: 500; color: #333;">{{ $contribution->category->name ?? 'General Fund' }}</td>
                                            <td class="text-success" style="padding: 12px 8px; vertical-align: middle; font-weight: 700; font-size: 14px;">{{ number_format($contribution->donation_amount, 2) }} TK</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;"><code style="font-size: 12px; color: #E74C3C; background: #FDEDEC; padding: 3px 6px; border-radius: 3px; font-weight: 600;">{{ $contribution->transaction_id }}</code></td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">
                                                @if($contribution->status === 'approved')
                                                    <span class="label label-success" style="padding: 5px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; display: inline-block;">
                                                        <i class="fa fa-check-circle"></i> Verified &amp; Settled
                                                    </span>
                                                @else
                                                    <span class="label" style="padding: 5px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; display: inline-block; background-color: #F39C12; color: #fff;">
                                                        <i class="fa fa-clock-o"></i> {{ ucfirst($contribution->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted" style="padding: 30px 15px; background: #FAFBFB; border-radius: 6px; border: 1px dashed #DCE4EC;">
                            <i class="fa fa-sticky-note-o" style="font-size: 32px; color: #BDC3C7; margin-bottom: 10px;"></i>
                            <p style="font-size: 13px; margin-bottom: 0;">No continuous fund donations logged yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection