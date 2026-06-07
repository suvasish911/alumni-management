@extends('panel.layout')

@section('content')



<form method="GET" action="{{ route('admin.donations.report') }}">

    <input type="date" name="start_date">

    <input type="date" name="end_date">

    <button type="submit">Filter Report</button>

</form>



<table class="table">

    <thead>

        <tr>

            <th>Project</th>

            <th>Amount</th>

            <th>Date</th>
            
        </tr>

    </thead>

    <tbody>

        @foreach($donations as $item)

            <tr>

                <td>{{ $item->project->name }}</td>

                <td>{{ $item->amount }}</td>

                <td>{{ $item->created_at->format('Y-m-d') }}</td>

            </tr>

        @endforeach

    </tbody>

    <tfoot>

        <tr>

            <th>Total</th>

            <th>{{ $totalAmount }} BDT</th>

            <th></th>

        </tr>

    </tfoot>

</table>

@endsection