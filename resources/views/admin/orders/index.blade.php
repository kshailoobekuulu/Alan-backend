@extends('admin.layout')

@section('header')
    Заказы
@endsection

@section('content')
    <div>
        <form action="{{route('orders.index')}}" method="get">
                <div class="row p-3 filter-bg">
                    <div class="col-md-4 p-0">
                        <input type="text" placeholder="Поиск..." name="q" class="form-control" value="{{request()->q}}">
                    </div>
                    <div class="col-md-4 p-0 pl-md-2 mt-2 mt-md-0">
                        <select name="status" class="form-control">
                            <option value="" {{ request()->status === "all" ? "selected" : ""}}>Все</option>
                            <option value="waiting" {{ request()->status === "waiting" ? "selected" : ""}}>В ожидании</option>
                            <option value="in_progress" {{ request()->status === "in_progress" ? "selected" : ""}}>В процессе</option>
                            <option value="on_its_way" {{ request()->status === "on_its_way" ? "selected" : ""}}>В пути</option>
                            <option value="delivered" {{ request()->status === "delivered" ? "selected" : ""}}>Доставлено</option>
                        </select>
                    </div>
                    <div class="col-md-3 p-0 pl-md-2 mt-2 mt-md-0">
                        <input type="date" name="date" value="{{ \Carbon\Carbon::now()}}" class="form-control">
                    </div>
                    <div class="col-md-1 text-right p-0 mt-2 mt-md-0">
                        <button class="btn btn-primary fa fa-search ml-1 m-sm-0" type="submit" style="line-height: 23px"></button>
                    </div>
                </div>
        </form>
    </div>
    <br>
    <div class="ml-n3 mr-n3 alert alert-info">Количество заказов: {{ $quantity }}</div>
    @foreach($orders as $order)
        <div class="row shadow-sm mt-2" >
            <div class="col-12 col-md-11">
                <a class="text-decoration-none" href="{{route("orders.show", $order->id)}}">
                    <div class="row p-3 mt-2 color-black">
                        <div class="col-12 col-lg-2 p-0">
                            <p class="align-middle mb-0">
                                Номер телефона: <span>{{ $order->phone }}</span>
                            </p>
                        </div>

                        <div class="col-12 col-lg-2 p-0 pl-lg-1">
                            <p class="align-middle mb-0">
                                Дополнительная информация:
                                @if($order->additional_information)
                                    <span>{{ $order->additional_information }}</span>
                                @else
                                    <span>Не указано</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-12 col-lg-2 p-0 pl-lg-1">
                            <p class="align-middle mb-0">
                                Адрес: {{ $order->address ? $order->address : "Не указано" }}
                            </p>
                        </div>
                        <div class="col-12 col-lg-2 p-0 pl-lg-1">
                            Общая сумма:
                            <span>{{ number_format($order->total_price, 2) }} сом</span>
                        </div>
                        <div class="col-12 col-lg-2 p-0 pl-lg-1">
                            <p class="align-middle mb-0">
                                Статус:
                                @if($order->status === 'waiting')
                                    <span style="color: #32e53d">В ожидании</span>
                                @elseif($order->status === 'in_progress')
                                    <span style="color: #bda321">В процессе</span>
                                @elseif($order->status === 'on_its_way')
                                    <span style="color: #3072e2">В пути</span>
                                @else
                                    <span style="color: #ef081a">Доставлено</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-1 p-0">
                <div class="text-right mt-lg-2">
                    <form action="{{route('orders.destroy', $order->id)}}" method="post" class="d-inline-block align-middle">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-success color-black align-middle" style="margin-right: 5px; margin-top: 30px">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{ $orders->appends(request()->input())->links() }}
@endsection
