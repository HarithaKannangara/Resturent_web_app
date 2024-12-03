@extends('layout.front', ['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container">
    <h1>Order Details - #{{ $order->id }}</h1>

    <!-- Selected Concessions -->
    <div class="mb-3">
        <strong>Selected Concessions:</strong>
        @if (!empty($order->selected_concessions))
            @php
                $selectedConcessions = is_array($order->selected_concessions)
                    ? $order->selected_concessions
                    : json_decode($order->selected_concessions, true);

                // Ensure quantities exist and are an array
                $quantities = is_array($order->quantities)
                    ? $order->quantities
                    : json_decode($order->quantities, true);

                $totalAmount = 0; // Initialize total amount
            @endphp

            <table class="table table-bordered" table id="example1">
                <thead>
                    <tr>
                        <th>Concession Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedConcessions as $concessionId)
                        @php
                            $concession = $concessions->find($concessionId);
                            $quantity = (int) ($quantities[$concessionId] ?? 0); // Ensure quantity is numeric
                        @endphp
                        @if ($concession)
                            <tr>
                                <td>{{ $concession->name }}</td>
                                <td>${{ number_format((float) $concession->price, 2) }}</td>
                                <td>{{ $quantity }}</td>
                                <td>
                                    @php
                                        $subtotal = (float) $concession->price * $quantity;
                                        $totalAmount += $subtotal;
                                    @endphp
                                    ${{ number_format($subtotal, 2) }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4">Unknown Concession (ID: {{ $concessionId }})</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <!-- Display total amount -->
            <div>
                <strong>Total Amount:</strong>
                <p>${{ number_format($totalAmount, 2) }}</p>
            </div>
        @else
            <p>No concessions selected for this order.</p>
        @endif
    </div>

    <!-- Send to Kitchen Time -->
    <div class="mb-3">
        <strong>Send to Kitchen Time:</strong>
        <p>{{ \Carbon\Carbon::parse($order->send_to_kitchen_time)->format('Y-m-d H:i:s') }}</p>
    </div>

    <!-- Order Status -->
    <div class="mb-3">
        <strong>Status:</strong>
        <p>
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
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="mb-3">
        @if ($order->status === 'Pending')
            <a href="{{ route('orders.sendToKitchen', $order->id) }}" class="btn btn-warning">Send to Kitchen</a>
        @elseif ($order->status === 'In-Progress')
            <p>The order is currently in progress.</p>
        @else
            <p>The order is complete.</p>
        @endif
    </div>
</div>
</div>
@endsection
