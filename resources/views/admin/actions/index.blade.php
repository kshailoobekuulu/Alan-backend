@extends('admin.layout')

@section('header')
    Акции
@endsection

@section('content')
    <div class="row">
        <p>
            <a href="{{ route('actions.create') }}" class="btn btn-success">Добавить акцию</a>
        </p>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Фото</th>
                <th scope="col">Продукты</th>
                <th colspan = '2' class = "text-center">Действия</th>

            </tr>
            </thead>
            <tbody>
            @foreach($actions as $action)
                <tr>
                    <th scope="row">{{ $action->title }}</th>
                    <td>{{ $action->price   }}</td>
                    <td>
                        <img src="{{ asset($action->photo) }}"
                             width="70"
                             height="50" />
                    </td>
                    <td>
                        @foreach($action->products as $product)
                            <span>{{$product->pivot->quantity}}:{{$product->name}}</span><br>
                        @endforeach
                    </td>
                    <td><a class = "btn btn-success float-right" href="{{route('actions.edit',$action->id)}}">Изменить</a></td>
                    <td>
                        <form action="{{route('actions.destroy',$action->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-success" value="Удалить" style="background-color: red;">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
