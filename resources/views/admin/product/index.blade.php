@extends('admin.index')

@section('content')
    <div class="col-md-10">
        <div class="content-box-large">
            <a  href="{{ route('admin.product.create') }}" class="btn btn-sm btn-success">Create product</a>

            <div class="panel-heading">
                <div class="panel-title">Product table</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Img</th>
                            <th>Brand</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)

                            <tr>
                                <td>{{ $loop->iteration + (($products->currentPage() - 1) * $products->perPage()) }}</td>
                                <td>{{ $product->name }}</td>
                                <td>   @if ($product->status)
                                        <p>active</p>
                                    @else
                                        <p class="text-danger">inactive</p>
                                    @endif
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if (Storage::disk('public')->exists($product->img))
                                        <img src="{{ asset('/storage/'.$product->img) }}" width="120">
                                    @else
                                        <img src="{{ asset($product->img) }}" width="120">
                                    @endif
                                </td>

                                <td>{{ $product->brand->name }}</td>
                                <td>
                                    <a href="{{ route('admin.product.show', ['product' => $product]) }}">Show</a>
                                    <a href="{{ route('admin.product.edit', ['product' => $product]) }}">Edit</a>
                                    <form action="{{ route('admin.product.destroy', compact('product')) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger btn-sm danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {!!  $products->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection()
