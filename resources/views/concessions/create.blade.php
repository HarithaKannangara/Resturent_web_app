@extends('layout.front',['main_page' > 'yes'])

@section('content')

<div class="content-wrapper">
<div class="container">
    <h1>Add Concession</h1>
    
    <form action="{{ route('concessions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</div>
@endsection
