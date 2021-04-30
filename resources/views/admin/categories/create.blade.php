@extends('admin.layout')

@section('header')
    Создать категорию
@endsection

@section('content')

    <form action="{{ route('categories.store')}}" method="post">
        @csrf

    @include('admin.categories.form')

        <input type="submit" value="создать" class="btn btn-success">
    </form>

@endsection
