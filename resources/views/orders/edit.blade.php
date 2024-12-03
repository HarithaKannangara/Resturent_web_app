@extends('layout.front', ['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container">
    <h1>Edit Order #{{ $order->id }}</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="concessions">Select Concessions</label>
            <select name="selected_concessions[]" id="concessions" class="form-control" multiple required>
                @foreach ($concessions as $concession)
                    <option value="{{ $concession->id }}"
                        @if(in_array($concession->id, is_array($order->selected_concessions) ? $order->selected_concessions : json_decode($order->selected_concessions, true))) selected @endif>
                        {{ $concession->name }} - ${{ number_format($concession->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="send_to_kitchen_time">Send to Kitchen Time</label>
            <input type="datetime-local" name="send_to_kitchen_time" class="form-control"
                   value="{{ \Carbon\Carbon::parse($order->send_to_kitchen_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Order</button>
    </form>
</div>
</div>
@endsection
