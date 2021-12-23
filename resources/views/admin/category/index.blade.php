@extends('admin.index')

@section('content')
    <div class="col-md-10">
        <div class="content-box-large">
            <a  href="{{ route('admin.category.create') }}" class="btn btn-sm btn-success">Create category</a>

            <div class="panel-heading">
                <div class="panel-title">Responsive Tables</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration + (($categories->currentPage() - 1) * $categories->perPage()) }}</td>
                                <td>{{ $category->name }}</td>
                                <td>   @if ($category->status)
                                            <p>active</p>
                                       @else
                                        <p class="text-danger">inactive</p>
                                       @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.category.show', ['category' => $category]) }}">Show</a>
                                    <a href="{{ route('admin.category.edit', ['category' => $category]) }}">Edit</a>
                                    <form action="{{ route('admin.category.destroy', compact('category')) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger btn-sm danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {!!  $categories->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
