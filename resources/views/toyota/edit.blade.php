@extends('layouts.index')

@section('content')
    <br />
    <form action="{{ url('toyota/'.$model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        @include('toyota._form')
    </form>
@endsection