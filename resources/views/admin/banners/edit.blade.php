@extends('admin.layout')

@section('header')
    Изменить баннер
@endsection

@section('content')

    <form action="{{ route( 'banners.update', $banner->id ) }}" method="post">
        @csrf
        @method('PUT')

    @include('admin.banners.form')

        <input type="submit" class="btn btn-success">
    </form>
@endsection
