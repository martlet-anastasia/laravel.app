@extends('admin.index')

@section('content')
    <div class="col-md-4">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-danger">{{ $error }}</div>
            @endforeach
        @endif

            <form method="POST" action="{{ route('admin.category.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter category name">
                </div>
                <div class="form-check">
                    <input type="checkbox" name="status" value="1" class="form-check-input">
                    <label class="form-check-label">Check for active status</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
@endsection
