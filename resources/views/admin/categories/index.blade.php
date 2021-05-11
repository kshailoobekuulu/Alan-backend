@extends('admin.layout')

@section('header')
    Категории
@endsection

@section('content')
    <div class="row">
        <p>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Добавить категорию</a>
        </p>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Слаг</th>
                <th scope="col">Иконка</th>
                <th scope="col">Фото</th>
                <th colspan = '2' class = "text-center">Действия</th>

            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->name }}</th>
                    <td>{{ $category->slug   }}</td>
                    <td>
                        <img src="{{ asset($category->category_icon) }}"
                             width="40"
                             height="50" />
                    </td>
                    <td>
                        <img src="{{ asset($category->photo) }}"
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
                    <td><a class = "btn btn-success float-right" href="{{route('categories.edit',$category->slug)}}">Изменить</a></td>
                    <td>
                        <form action="{{route('categories.destroy',$category->id)}}" method="post">
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
