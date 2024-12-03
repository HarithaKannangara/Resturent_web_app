
@extends('layout.front',['main_page' > 'yes'])
@section('content')
<div class="content-wrapper">
    <div class="container">
        <h1>Orders</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3" >Create Order</a>

        <table class="table mt-3" table id="example1">
            <thead>
                <tr>
                    <th>ID</th>

                    <th>Send to Kitchen Time</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>

                    <td>{{ \Carbon\Carbon::parse($order->send_to_kitchen_time)->format('Y-m-d H:i:s') }}</td> <!-- formatted datetime -->
                    <td>
                        <span class="badge"
                            @if ($order->status === 'Pending')
                                style="background-color: yellow; color: black;"
                            @elseif ($order->status === 'In-Progress')
                                style="background-color: blue; color: white;"
                            @elseif ($order->status === 'Completed')
                                style="background-color: green; color: white;"
                            @endif>
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Show</a>

                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
