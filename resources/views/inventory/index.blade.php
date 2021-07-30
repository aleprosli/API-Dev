@extends('layouts.app')

@section('content')
<div class="card-body">
    <table class ="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>SerialNumber</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $key => $inventory)
            <tr>
                <td>{{ $inventory -> name ?? '' }}</td>
                <td>{{ $inventory -> serialnumber ?? '' }}</td>
                <td>{{ $inventory -> type ?? ''}}</td>
                <td>{{ $inventory -> amount ?? ''}}</td>
                <td><div><a href="{{ route('inventory-purchase', $inventory) }}" class="btn btn-success">Purchase</a></div></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
    <table class ="table">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Status Payment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $key => $purchase)
            <tr>
                <td>{{ $purchase->real_price }}</td>
                <td>
                    @if($purchase->payment_status == 0) 
                        NOT PAID
                    @else
                    PAID
                    @endif
                </td>
                <td>
                    @if($purchase->payment_status == 0) 
                    <div><a href="{{ $purchase->payment_link }}" class="btn btn-danger">Pay Sekarang</a></div>
                    @else
                    PAID
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection