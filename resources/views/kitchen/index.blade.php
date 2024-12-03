@extends('layout.front', ['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container">
    <h1>Kitchen Orders</h1>

    @if ($orders->isEmpty())
        <p>No orders are currently in progress.</p>
    @else
        <table class="table table-striped" table id="example1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Sent Time</th>
                    <th>Selected Concessions</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td> <a  href="{{ route('orders.show', $order->id) }}" class="btn btn-info">No. {{ $order->id }} Show</a></td>
                        <td>{{ \Carbon\Carbon::parse($order->send_to_kitchen_time)->format('Y-m-d H:i') }}</td>
                        <td>
                            <ul>
                                @foreach ($order->concessions as $concession)
                                    <li>{{ $concession['name'] }} </li>
                                @endforeach
                            </ul>

                        </td>
                        <td >
                            <span class="badge" style="background-color: blue; color: white;" >{{ $order->status }}</td>
                        <td >
                            @if ($order->status == 'In-Progress')

                                <form action="{{ route('kitchen.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">Mark as Completed</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</div>
@endsection
