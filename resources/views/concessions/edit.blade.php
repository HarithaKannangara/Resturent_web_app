@extends('layout.front',['main_page' > 'yes'])

@section('content')
<div class="content-wrapper">
<div class="container">
    <h1>Edit Concession</h1>
    <form action="{{ route('concessions.update', $concession) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $concession->name }}" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $concession->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $concession->price }}" required step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection
