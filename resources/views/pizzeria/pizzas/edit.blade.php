@extends('layouts.app')
@section('content')
    {!! Form::open()->put()->route('pizzas.update',[$pizza->id])->fill($pizza) !!}
    @include('pizzeria.pizzas._form')
    {!! Form::close() !!}
@endsection