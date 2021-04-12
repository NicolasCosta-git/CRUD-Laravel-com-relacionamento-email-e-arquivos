@extends('layouts.app')
@section('content')
    {!! Form::open()->put()->route('users.update', [$user->id])->multipart()->fill($user) !!}
    @include('pizzeria.users._form')
    {!! Form::close() !!}
@endsection
