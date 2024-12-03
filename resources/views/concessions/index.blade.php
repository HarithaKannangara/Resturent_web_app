@extends('layout.front',['main_page' => 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container">
    <h1>Concessions</h1>
    <a href="{{ route('concessions.create') }}" class="btn btn-primary mb-3">Add Concession</a>
    <table class="table" table id="example1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($concessions as $concession)
            <tr>
                <td>{{ $concession->name }}</td>
                <td>{{ $concession->description }}</td>
                <td>${{ number_format($concession->price, 2) }}</td>
                <td>
                    <img src="{{ asset($concession->image_path) }}" alt="Image" width="50">
                </td>
                <td>
                    <a href="{{ route('concessions.edit', $concession) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('concessions.destroy', $concession) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
