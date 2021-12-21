@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @dump($errors)
        <input type="text" name="name">
        <br>
        <input type="file" name="logo">
        <br>
        <textarea name="description" cols="30" rows="10"></textarea>
        <br>
        <input type="checkbox" name="status" value="1"">
        <br>
        <input type="text" name="creation_year">
        <br>
        <button type="submit" class="btn btn-sm btn-success">Send</button>
    </form>
@endsection
