@extends('admin.layout')

@section('header')
    Добавить продукт
@endsection

@section('content')

    <form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf

    @include('admin.products.form')

        <input type="submit" value="создать" class="btn btn-success">
    </form>

@endsection
