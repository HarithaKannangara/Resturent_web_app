@extends('layout.front', ['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container">
    <h1>Orders</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3" >Create Order</a>

    <table class="table mt-3" table id="example1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Selected Concessions</th>
                <th>Send to Kitchen Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>
                    <!-- Check if selected_concessions is a JSON string or an array -->
                    @if (is_string($order->selected_concessions))
                        {{ implode(', ', json_decode($order->selected_concessions)) }}
                    @elseif (is_array($order->selected_concessions))
                        {{ implode(', ', $order->selected_concessions) }}
                    @else
                        No Concessions
                    @endif
                </td>
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

                    <!-- Only show the 'Edit' and 'Send to Kitchen' buttons if the order is not complete -->
                    @if ($order->status !== 'Completed')
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('orders.sendToKitchen', $order->id) }}" class="btn btn-success">Send to Kitchen</a>
                    @endif

                    <!-- Only show the 'Delete' button if the order is not complete -->
                    @if ($order->status !== 'Complete')
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
