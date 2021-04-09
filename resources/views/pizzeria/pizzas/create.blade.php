@extends('layouts.app')
@section('content')
    {!! Form::open()->post()->route('pizzas.store') !!}
    @include('pizzeria.pizzas._form')
    {!! Form::close() !!}
@endsection
