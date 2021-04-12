@extends('layouts.app')
@section('content')
    {!! Form::open()->put()->route('orders.update', [$order->id])->fill($order) !!}
    @include('pizzeria.orders._form')
    {!! Form::close() !!}
@endsection
