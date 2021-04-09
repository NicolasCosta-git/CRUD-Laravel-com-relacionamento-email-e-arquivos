@extends('layouts.app')
@section('content')
    {!! Form::open()->post()->route('clients.store')->multipart() !!}
    @include('pizzeria.clients._form')
    {!! Form::close() !!}
@endsection
