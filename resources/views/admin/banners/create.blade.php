@extends('admin.layout')

@section('header')
    Создать баннер
@endsection

@section('content')

    <form action="{{ route('banners.store')}}" method="post" enctype="multipart/form-data">
        @csrf

    @include('admin.banners.form')

        <input type="submit" value="создать" class="btn btn-success">
    </form>

@endsection
