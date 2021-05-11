@extends('admin.layout')

@section('header')
    Создать акцию
@endsection

@section('content')

    <form action="{{ route('actions.store')}}" method="post" enctype="multipart/form-data">
        @csrf

    @include('admin.actions.form')

        <input type="submit" value="создать" class="btn btn-success">
    </form>

@endsection
