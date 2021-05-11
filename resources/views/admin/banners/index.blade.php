@extends('admin.layout')

@section('header')
    Баннеры
@endsection

@section('content')
    <div class="row">
        <p>
            <a href="{{ route('banners.create') }}" class="btn btn-success">Добавить баннер</a>
        </p>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Описание</th>
                <th scope="col">Название</th>
                <th scope="col">Фото</th>
                <th colspan = '2' class = "text-center">Действия</th>

            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
                <tr>
                    <th scope="row">{{ $banner->description }}</th>
                    <td>{{ $banner->title   }}</td>
                    <td>
                        <img src="{{ asset($banner->photo) }}"
                             width="70"
                             height="50" />
                    </td>
{{--                    <td>--}}
{{--                        <select name="categories[]" id="category" class="form-control">--}}
{{--                            @foreach($category->products as $product)--}}
{{--                                <option value="{{$product->id}}">{{$product->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </td>--}}
                    <td><a class = "btn btn-success float-right" href="{{route('banners.edit',$banner->id)}}">Изменить</a></td>
                    <td>
                        <form action="{{route('banners.destroy',$banner->id)}}" method="post">
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
