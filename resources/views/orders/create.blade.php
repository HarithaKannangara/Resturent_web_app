@extends('layout.front', ['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container mt-5">
    <h1>Create Order</h1>

    <!-- Order Form -->
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Select Concessions -->
        <div class="form-group">
            <label for="selected_concessions">Select Concessions:</label>
            <div id="concessions-list">
                @foreach ($concessions as $concession)
                <div class="form-check">
                    <input type="checkbox" name="selected_concessions[]" value="{{ $concession->id }}"
                           id="concession_{{ $concession->id }}"
                           class="form-check-input concession-checkbox">
                    <label for="concession_{{ $concession->id }}" class="form-check-label">
                        {{ $concession->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Selected Concessions Table -->
        <div class="mt-3">
            <h4>Selected Concessions</h4>
            <table class="table table-bordered" id="selected-concessions-table" table id="example1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be dynamically added here -->
                </tbody>
            </table>
        </div>

        <!-- Send to Kitchen Time -->
        <div class="form-group mt-3">
            <label for="send_to_kitchen_time">Send to Kitchen Time:</label>
            <input type="datetime-local" name="send_to_kitchen_time" id="send_to_kitchen_time" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Create Order</button>
    </form>
</div>

<!-- Dynamic JavaScript for Selected Concessions -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const concessionsTableBody = document.querySelector("#selected-concessions-table tbody");
        const checkboxes = document.querySelectorAll(".concession-checkbox");

        // Automatically set the current date and time in the "Send to Kitchen Time" field
        const sendToKitchenTimeField = document.getElementById("send_to_kitchen_time");
        const currentDate = new Date().toISOString().slice(0, 16); // Format as yyyy-MM-ddTHH:mm
        sendToKitchenTimeField.value = currentDate;

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                const concessionId = this.value;
                const concessionName = this.nextElementSibling.textContent.trim();

                // Check if this checkbox is checked
                if (this.checked) {
                    // Add a new row for the selected concession
                    const row = document.createElement("tr");
                    row.setAttribute("data-concession-id", concessionId);

                    row.innerHTML = `
                        <td>${concessionId}</td>
                        <td>${concessionName}</td>
                        <td>
                            <input type="number" name="quantities[${concessionId}]" min="1" value="1" class="form-control">
                        </td>
                    `;

                    concessionsTableBody.appendChild(row);
                } else {
                    // Remove the row for the deselected concession
                    const row = concessionsTableBody.querySelector(`tr[data-concession-id="${concessionId}"]`);
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    });
</script>
</div>
@endsection
