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
            <hr>

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
{{--                    <div class="col-12 col-lg-1 text-right">--}}
                        <button type="button" data-order="{{$order->id}}" data-product="{{$product->id}}" class="btn btn-outline-danger remove-product-data">Удалить</button>
{{--                    </div>--}}
                </div>
            @endforeach
            <h3><u>Акции</u></h3>
            <hr>
            @foreach($actions as $key => $action)
                <div class="row shadow-sm  pt-3 pb-3 mb-2 justify-content-center">
                    <div class="col-12 col-lg-3">
                        <h5 class="align-middle d-inline-block mb-lg-0 mb-2">{{ $action->title }}</h5>
                    </div>
                    <div class="col-12 col-lg-2 p-lg-0">
                        <span class="action-price-{{$key}}">Цена: {{$action->price}} сом</span>
                    </div>
                    <div class="col-12 col-lg-3 p-lg-0">
                        Количество:
                        {{--                        {{ Form::number('quantity['."$product->id".']', $product->pivot->quantity, ['class' => ' quantity-input', 'min' => 1]) }}--}}
                        <input type="hidden" name="actions[{{$key}}][id]" value="{{$action->id}}">
                        <input type="number" name="actions[{{$key}}][quantity]"
                               data-price="{{$action->price}}" data-key="{{$key}}" value="{{$action->pivot->quantity}}"
                               class="form-control change-action-quantity" min="1">
                    </div>
                    <div class="col-12 col-lg-3 p-lg-0 total-action-price-{{$key}}">
                        Общая сумма: <span class="total-action-price-span">{{ $action->price * $action->pivot->quantity }}</span> сом
                    </div>
{{--                    <div class="col-12 col-lg-1 text-right">--}}
                        <button type="button" data-order="{{$order->id}}" data-action="{{$action->id}}" class="btn btn-outline-danger remove-product-data">Удалить</button>
{{--                    </div>--}}
                </div>
            @endforeach
            <div class="total-total-price">
            <h5>Общая сумма: <span class="total-total-price-span">{{ $order->total_price }}</span> сом</h5><br>
            </div>
        </div>
        <div class="form-group">
            <label for="additional_information">Дополнительная информация</label>
            <input type="text" name="additional_information" class="form-control col-12 col-md col-md-4 mb-2" value="{{$order->additional_information?$order->additional_information:''}}" id="additional_information">
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

        let actionTotalPrice = 0;
        let allTotalPrice = 0;
        let allProductTotalPrice = 0;
        $(document).on('click', '.remove-product-data', function () {
            allTotalPrice = 0;
            $(this).parent().remove();
            $('span.total-product-price-span').each(function () {
                allTotalPrice += parseInt($(this).text());
            });
            $('span.total-action-price-span').each(function () {
                allTotalPrice += parseInt($(this).text());
            });
            $('.form-main').find('.total-total-price').html('<h5>Общая сумма: <span class="total-total-price-span">'+
                allTotalPrice
                +'</span>  сом</h5>');
            $('.total-input-value').val();
        });

        $( ".change-product-quantity" ).change(function() {
            var newQuantity = parseInt($(this).val());
            var productPrice = parseInt($(this).attr('data-price'));
            var index = $(this).attr('data-key');

            $('.form-main').find('.total-product-price-'+index).html('Общая сумма: <span class="total-product-price-span">'+
                productPrice * newQuantity
            +'</span>  сом');

            allProductTotalPrice = 0;
            allTotalPrice = 0;
            $('span.total-product-price-span').each(function () {
                allProductTotalPrice += parseInt($(this).text());
                // console.log(allProductTotalPrice);
            });
            if (actionTotalPrice === 0) {
                $('span.total-action-price-span').each(function () {
                    actionTotalPrice += parseInt($(this).text());
                });
            }
            allTotalPrice += actionTotalPrice+allProductTotalPrice;
            // console.log(allTotalPrice);
            $('.form-main').find('.total-total-price').html('<h5>Общая сумма: <span class="total-total-price-span">'+
                allTotalPrice
                +'</span>  сом</h5>');
        });


        $( ".change-action-quantity" ).change(function() {
            var newQuantity = parseInt($(this).val());
            var actionPrice = parseInt($(this).attr('data-price'));
            var index = $(this).attr('data-key');

            $('.form-main').find('.total-action-price-'+index).html('Общая сумма: <span class="total-action-price-span">'+
                actionPrice * newQuantity
                +'</span>  сом');
            actionTotalPrice = 0;
            allTotalPrice = 0;
            $('span.total-action-price-span').each(function () {
                actionTotalPrice += parseInt($(this).text());
            });
            if (allProductTotalPrice === 0) {
                $('span.total-product-price-span').each(function () {
                    allProductTotalPrice += parseInt($(this).text());
                });
            }
            allTotalPrice += actionTotalPrice+allProductTotalPrice;
            // console.log(allTotalPrice);
            $('.form-main').find('.total-total-price').html('<h5>Общая сумма: <span class="total-total-price-span">'+
                allTotalPrice
                +'</span>  сом</h5>');
            $('.total-input-value').val();
        });

    </script>

@endsection
