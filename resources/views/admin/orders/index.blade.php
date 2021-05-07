{{--@extends('admin.layout')--}}

{{--@section('header')--}}
{{--    Заказы--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <div>--}}
{{--        <form action="{{route('orders.index')}}" method="get"></form>--}}
{{--        <div class="row p-3 filter-bg">--}}
{{--            <div class="col-md-3 p-0">--}}
{{--                <input type="text" name="q" class="form-control">--}}
{{--            </div>--}}
{{--            <div class="col-md-3 p-0 pl-md-2 mt-2 mt-md-0">--}}
{{--                {{ Form::select('status', array_merge([0 => __('messages.ALL')],getStatuses()),        --}}
{{--                    [request()->status] , ['class' => 'form-control']) }}                              --}}
{{--                <select name="status" class="form-control">--}}
{{--                     <option value="all" {{ request()->status === "all" ? "selected" : ""}}>Все</option>--}}
{{--                    <option value="waiting" {{ request()->status === "waiting" ? "selected" : ""}}>В ожидании</option>--}}
{{--                    <option value="in_progress" {{ request()->status === "in_progress" ? "selected" : ""}}>В процессе</option>--}}
{{--                    <option value="on_its_way" {{ request()->status === "on_its_way" ? "selected" : ""}}>В пути</option>--}}
{{--                    <option value="delivered" {{ request()->status === "delivered" ? "selected" : ""}}>Доставлено</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 p-0 pl-md-2 mt-2 mt-md-0">--}}
{{--                {{ Form::date('date', request()->date ? request()->date : \Carbon\Carbon::now(), ['class' => 'form-control']) }}--}}
{{--                <input type="date" value="{{request()->date ? request()->date : Carbon\Carbon::now()}}">--}}
{{--                <input type="date" value="{{Carbon\Carbon::now()->format('Y-m-d')}} " class="form-control">--}}
{{--            </div>--}}
{{--            <div class="col-md-1 text-right p-0 mt-2 mt-md-0">--}}
{{--                <button class="btn btn-primary fa fa-search ml-1 m-sm-0" type="submit" style="line-height: 23px"></button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    <br>--}}
{{--    <div class="ml-n3 mr-n3 alert alert-info">{{ "Количество заказов" }}: {{ $quantity }}</div>--}}
{{--    @foreach($orders as $order)--}}
{{--        <div class="row shadow-sm mt-2">--}}
{{--            <div class="col-12 col-md-11">--}}
{{--                <a class="text-decoration-none" href="{{route("orders.show", $order->id)}}">--}}
{{--                    <div class="row p-3 mt-2 color-black">--}}
{{--                        <div class="col-12 col-lg-2 p-0">--}}
{{--                            <p class="align-middle mb-0">--}}
{{--                                {{ __('messages.STORE') }}: <span>{{ $order->store->name }}</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-lg-2 p-0">--}}
{{--                            <p class="align-middle mb-0">--}}
{{--                                {{ __('messages.PHONE_NUMBER') }}: <span>{{ $order->phone_number }}</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}

{{--                        <div class="col-12 col-lg-2 p-0 pl-lg-1">--}}
{{--                            <p class="align-middle mb-0">--}}
{{--                                {{ __('messages.RECEIVER_NAME') }}:--}}
{{--                                @if($order->receiver_name)--}}
{{--                                    <span>{{ $order->receiver_name }}</span>--}}
{{--                                @else--}}
{{--                                    <span>{{ __('messages.NOT_PROVIDED') }}</span>--}}
{{--                                @endif--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-lg-2 p-0 pl-lg-1">--}}
{{--                            <p class="align-middle mb-0">--}}
{{--                                {{ __('messages.ADDRESS') }}: {{ $order->address ? $order->address : __('messages.NOT_PROVIDED') }}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-lg-2 p-0 pl-lg-1">--}}
{{--                            {{ __('messages.TOTAL_PRICE') }}:--}}
{{--                            <span>{{ number_format($order->total_price, 2) }} {{ __('messages.SOM') }}</span>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-lg-2 p-0 pl-lg-1">--}}
{{--                            <p class="align-middle mb-0">--}}
{{--                                {{ __('messages.STATUS') }}: <span class="{{ $order->status }}">{{ getStatus($order->status) }}</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="col-lg-1 p-0">--}}
{{--                <div class="text-right mt-lg-2">--}}
{{--                    {!! Form::open(['url' => route('orders.destroy', $order->id), 'method' => "POST"--}}
{{--                            , 'class' => 'd-inline-block delete-order align-middle']) !!}--}}
{{--                    {{ Form::hidden('_method', 'DELETE') }}--}}
{{--                    <button type="submit" class="btn p-1 fa fa-2x fa-trash-o color-red align-middle"></button>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--    {{ $orders->appends(request()->input())->links() }}--}}
{{--@endsection--}}
