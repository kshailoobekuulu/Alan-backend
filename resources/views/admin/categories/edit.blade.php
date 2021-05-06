@extends('admin.layout')

@section('header')
    Изменить категорию
@endsection

@section('content')

    <form action="{{ route( 'categories.update', $category->id ) }}" method="post">
        @csrf
        @method('PUT')

    @include('admin.categories.form')

        <input type="submit" class="btn btn-success">
    </form>
@endsection
