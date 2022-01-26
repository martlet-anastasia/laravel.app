@extends('admin.index')

@section('content')
    <div class="col-md-4">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="{{ route('admin.product.store') }} " enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="Enter price">
            </div>
            <div class="form-group">
                <input type="file" name="img" class="form-control" placeholder="Add image">
            </div>
            <div class="form-group">
                <select name="brandID">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input type="checkbox" name="status" value="1" class="form-check-input">
                <label class="form-check-label">Check for active status</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
