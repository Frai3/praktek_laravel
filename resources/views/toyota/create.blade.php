@extends('layouts.index')

@section('content')
    <br />
    <form action="{{ url('toyota') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('toyota._form')
    </form>
@endsection