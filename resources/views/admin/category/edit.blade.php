@extends('admin.index')

@section('content')
    <div class="col-md-4">
        <form method="POST" action="{{ route('admin.category.update', ['category' => $category]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>
            <div class="form-check">

                <input type="checkbox" name="status" value="1" class="form-check-input"
                       {{ $category->status ? "checked='true'" : "" }}>
                <label class="form-check-label">Check for active status</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
