@extends('layouts.app')
@section('content')
    {!! Form::open()->put()->route('clients.update',[$client->id])->multipart()->fill($client) !!}
    @include('pizzeria.clients._form')
    {!! Form::close() !!}
@endsection