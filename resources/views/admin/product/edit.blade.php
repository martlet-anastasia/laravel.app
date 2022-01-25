@extends('admin.index')

@section('content')
    <div class="col-md-4">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="{{ route('admin.product.update', ['product' => $product]) }} " enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter product name" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="Enter price" value="{{ $product->price }}">
            </div>
            <div class="form-group">
                <input type="file" name="img" class="form-control" placeholder="Add image">
                @if (Storage::disk('public')->exists($product->img))
                    <img src="{{ asset('/storage/'.$product->img) }}" width="120">
                @else
                    <img src="{{ asset($product->img) }}" width="120">
                @endif
            </div>
            <div class="form-group">
                <select name="brandID">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if($brand->id === $product->brand) selected @endif>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input type="checkbox" name="status" value="1" class="form-check-input"
                    {{ $product->status ? "checked='true'" : "" }}>
                <label class="form-check-label">Check for active status</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

