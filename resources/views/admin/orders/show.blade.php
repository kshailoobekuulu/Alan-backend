@extends('admin.layout')

@section('header')
    {{ $order->address }}: {{ $order->phone}}
@endsection

@section('content')
    <form action="{{route('orders.update', $order->id)}}" method="post">
        @method('PUT')
        @csrf
        <div class="m-3 form-main">
            <h3><u>Продукты</u></h3>

            @foreach($products as $key => $product)
                <div class="row shadow-sm  pt-3 pb-3 mb-2 justify-content-center">
                    <div class="col-12 col-lg-3">
                        <h5 class="align-middle d-inline-block mb-lg-0 mb-2">{{ $product->name }}</h5>
                    </div>
                    <div class="col-12 col-lg-2 p-lg-0">
                        <span class="product-price-{{$key}}">Цена: {{$product->price}} сом</span>
                    </div>
                    <div class="col-12 col-lg-3 p-lg-0 ">
                        Количество:
{{--                        <input type="number" name="quantityP[{{$product->id}}]" value="{{$product->pivot->quantity}}" class="quantity-input" min="1">--}}
                        <input type="hidden" name="products[{{$key}}][id]" value="{{$product->id}}">
                        <input type="number" name="products[{{$key}}][quantity]"
                              data-price="{{$product->price}}" data-key="{{$key}}" value="{{$product->pivot->quantity}}"
                               class="form-control change-product-quantity" min="1">
                    </div>
                    <div class="col-12 col-lg-3 p-lg-0 total-product-price-{{$key}}">
                        Общая сумма: <span class="total-product-price-span">{{ $product->price * $product->pivot->quantity }}</span> сом
                    </div>
                    <div class="col-12 col-lg-1 text-right">
                        <button type="button" data-order="{{$order->id}}" data-product="{{$product->id}}" class="btn btn-outline-danger">Удалить</button>
                    </div>
                </div>
            @endforeach
            <h3><u>Акции</u></h3>
            @foreach($actions as $action)
                <div class="row shadow-sm  pt-3 pb-3 mb-2 justify-content-center">
                    <div class="col-12 col-lg-3">
                        <h5 class="align-middle d-inline-block mb-lg-0 mb-2">{{ $action->title }}</h5>
                    </div>
                    <div class="col-12 col-lg-2 p-lg-0">
                        <span class="">Цена: {{$action->price}} сом</span>
                    </div>
                    <div class="col-12 col-lg-3 p-lg-0">
                        Количество:
                        {{--                        {{ Form::number('quantity['."$product->id".']', $product->pivot->quantity, ['class' => ' quantity-input', 'min' => 1]) }}--}}
                        <input type="number" name="'quantityA['.{{$action->id}}.']'" value="{{$action->pivot->quantity}}" class="quantity-input" min="1">
                    </div>
                    <div class="col-12 col-lg-3 p-lg-0">
                        Общая сумма: {{ $action->price * $action->pivot->quantity }} сом
                    </div>
                    <div class="col-12 col-lg-1 text-right">
                        <button type="button" data-order="{{$order->id}}" data-action="{{$action->id}}" class="btn btn-outline-danger">Удалить</button>
                    </div>
                </div>
            @endforeach
                <br>
            <h5>Общая сумма: {{ $order->total_price }} сом</h5>
                <br><br>
        </div>
        <div class="form-group">
            <label for="additional_information">Дополнительная информация</label>
            <input type="text" name="name" class="form-control col-12 col-md col-md-4 mb-2" value="{{$order->additional_information?$order->additional_information:''}}" id="additional_information">
        </div>
        <div class="form-group">
            <label for="address">Адрес</label>
            <input type="text" name="address" value="{{$order->address ? $order->address : ''}}" class="form-control col-12 col-md-4 mb-2" id="address">
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                <option value="waiting">В ожидании</option>
                <option value="in_progress">В процессе</option>
                <option value="on_its_way">В пути</option>
                <option value="delivered">Доставлено</option>
            </select>
        </div>
        <input type="submit" value="Сохранить" class="btn btn-primary align-top mt-2">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        let allProductTotalPrice = 0;
        let actionTotalPrice = 0;
        let allTotalPrice = 0;

        $( ".change-product-quantity" ).change(function() {
            var newQuantity = parseInt($(this).val());
            var productPrice = parseInt($(this).attr('data-price'));
            var index = $(this).attr('data-key');

            $('.form-main').find('.total-product-price-'+index).html('Общая сумма: <span class="total-product-price-span">'+
                productPrice * newQuantity
            +'</span>  сом');

            $('span.total-product-price-span').each(function () {
                var spn = $(this);
                allProductTotalPrice += parseInt($(this).text());
            });

            allTotalPrice += allProductTotalPrice + actionTotalPrice;


        });


        $( ".change-action-quantity" ).change(function() {
            var newQuantity = parseInt($(this).val());
            var productPrice = parseInt($(this).attr('data-price'));
            var index = $(this).attr('data-key');

            $('.form-main').find('.total-product-price-'+index).html('Общая сумма: <span class="total-product-price-span">'+
                productPrice * newQuantity
                +'</span>  сом');

            $('span.total-action-price-span').each(function () {
                var spn = $(this);
                actionTotalPrice += parseInt($(this).text());
            });

            allTotalPrice += allProductTotalPrice + actionTotalPrice;

        });

        $( document ).ready(function() {

        });

    </script>

@endsection
