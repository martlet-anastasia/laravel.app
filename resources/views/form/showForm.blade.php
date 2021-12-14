@extends('layouts.shop_layout')

@section('content')
    <form action="{{ route('namePostForm') }}" method="post">
        @csrf
        <input type="text" name="name">
        <button type="submit">Send</button>
    </form>
@endsection
