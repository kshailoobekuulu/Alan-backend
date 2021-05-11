@extends('admin.layout')

@section('header')
    Изменить продукт
@endsection

@section('content')
    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('admin.products.form')
        <input type="submit" class="btn btn-success">
    </form>
@endsection
