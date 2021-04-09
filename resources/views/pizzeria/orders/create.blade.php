@extends('layouts.app')
@section('content')
    {!! Form::open()->post()->route('orders.store') !!}
    @include('pizzeria.orders._form')
    {!! Form::close() !!}
@endsection
