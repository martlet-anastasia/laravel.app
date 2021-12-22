@extends('admin.index')

@section('content')
    <div class="col-md-10">
        <div class="content-box-large">
            <a  href="{{ route('admin.category.edit', ['category' => $category]) }}" class="btn btn-sm btn-warning">Edit category</a>

            <div class="panel-heading">
                <div class="panel-title">Responsive Tables</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($category->toArray() as $key => $value)
                                <th>{{ $key }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            @foreach($category->toArray() as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
