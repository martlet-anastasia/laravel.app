@extends('layouts.admin')

@section('content')
    <div class="col-md-10">
        <div class="content-box-large">
            <a  href="{{ route('admin.brand.create') }}" class="btn btn-sm btn-success">Create brand</a>

            <div class="panel-heading">
            <div class="panel-title">Responsive Tables</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Brand Name</th>
                        <th></th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($brands as $brand)
                    <tr>
                        <td>{{ $loop->iteration + (($brands->currentPage() - 1) * $brands->perPage()) }}</td>
                        <td>{{ $brand->name }}</td>
                        <td></td>
                        <td>
                            <a href="{{ route('admin.brand.show', ['brand' => $brand->id]) }}">Show</a>
                            <a href="{{ route('admin.brand.edit', ['brand' => $brand]) }}">Edit</a>
                            <form action="{{ route('admin.brand.destroy', compact('brand')) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link btn-sm">Delete</button>
                            </form>
{{--                            <a href="">Delete</a> here we need to add Ajax to process the request--}}
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                {!!  $brands->links() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
