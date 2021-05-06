@extends('admin.layout')

@section('header')
    Продукты
@endsection

@section('content')
    <div class="row">
        <a href="{{ route('products.create') }}" class="btn btn-success">Добавить продукт</a>
    </div>
    <br>
    <div>
        <div>
            <form action="get" method="{{route("products.index")}}">
                <div class="row p-3 filter-bg">
                    <div class="col-md-3 p-0">
                        <input type="text" name="q" value="{{request()->q}}" class="form-control" placeholder="Поиск продуктов">
                    </div>
                    <div class="col-md-3 pl-md-2 p-0 mt-1 mt-md-0">
                        <select name="category" class="form-control">
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{$category->id}}" class="form-control">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 pl-md-2 p-0 mt-1 mt-md-0">
                        <select name="all" class="form-control">
                            <option value="all">Все</option>
                        </select>
                    </div>
                    <div class="col-md-1 text-right p-0 mt-1 mt-md-0">
                        <button class="btn btn-primary fa fa-search ml-1 m-sm-0" type="submit" style="line-height: 23px"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row alert alert-info">Количество продуктов: {{ $quantity }}</div>
    <br>
    <div class="row shadow-sm p-2 mt-2 align-items-center " style="background: #1b1b1b; color: whitesmoke">

        <div class="col-4 col-sm-3 col-md-2 col-lg-1 p-0">
            <b>Фото</b>
        </div>

        <div class="col-8 justify-content-center col-md-10 col-lg-10">
            <div class="row align-content-center">
                <div class="col-lg-2 pl-1 p-0 align-middle"><h5>Имя</h5></div>
                <div class="col-lg-2 pl-1 p-0 align-middle"><b>Цена</div>
                <div class="col-lg-2 pl-1 p-0 align-middle">
                   Категория
                </div>
            </div>
        </div>
        <div class="col-lg-1 p-0">
            <div class="text-right">
                Действие
            </div>
        </div>
    </div>
    @foreach($products as $product)
        <div class="row shadow-sm p-2 mt-2 align-items-center">

            <div class="col-4 col-sm-3 col-md-2 col-lg-1 p-0 overflow-hidden">
                @if($product->photo)
                    <img class="image-list" src="{{ $product->photo }}"
                         alt="{{__('messages.PRODUCT_IMAGE')}}">
                @else
                    <img class="image-list" src="{{ asset('/images/image-not-found.png') }}" alt="">
                @endif
            </div>

            <div class="col-8 justify-content-center col-md-10 col-lg-10">
                <div class="row align-content-center">
                    <div class="col-lg-2 pl-1 p-0 align-middle"><h5>{{ $product->name }}</h5></div>
                    <div class="col-lg-2 pl-1 p-0 align-middle"><b>{{ number_format($product->price, 2) }} сом</b></div>
                    <div class="col-lg-2 pl-1 p-0 align-middle">
                        <select name="products[]" class="form-control">
                            @foreach($product->categories as $category)
                                <option value="{{$category->id}}"><b>{{$category->name}}</b></option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 p-0">
                <div class="text-right">
                    <a type="button" href="{{ route("products.edit", $product->id) }}" class = "fa  fa-edit p-1 align-bottom">
                        <button type="submit" class="btn btn-success color-black">Изменить</button>
                    </a>
                    <form action="{{route('products.destroy',$product->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-success color-black" style="margin-right: 5px">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
