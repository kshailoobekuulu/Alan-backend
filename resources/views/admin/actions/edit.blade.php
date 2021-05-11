@extends('admin.layout')

@section('header')
    Изменить акцию
@endsection

@section('content')

    <form action="{{ route( 'actions.update', $action->id ) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

    @include('admin.actions.form')

        <input type="submit" class="btn btn-success">
    </form>
@endsection
