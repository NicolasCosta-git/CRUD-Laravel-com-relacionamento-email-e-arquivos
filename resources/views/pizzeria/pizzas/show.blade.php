@extends('layouts.app')
@section('content')
    <div class="col d-flex justify-content-center">
        <div class="col-6">
            <h2 class="text-center card-header">
                Pizza de {{ $pizza->flavour }}
            </h2>
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center mb-5">
                        <div class="col-md-5 text-center">
                            <h3>Sabor</h3>
                            <hr>
                            <span>{{ $pizza->flavour }}</span>
                        </div>
                        <div class="col-md-5 text-center">
                            <h3>Preço</h3>
                            <hr>
                            <span>{{ "R$ " . $pizza->price }}</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 text-center card-header">
                            <h3>Ingredientes</h3>
                            <hr>
                            <span>{{ $pizza->ingredients }}</span>
                        </div>
                        {!! Form::open()->delete()->route('pizzas.destroy', [$pizza->id]) !!}
                        <div class="row d-flex justify-content-center mt-3">
                            @role('super_administrador')
                            <div class="col-md-4 text-center">
                                <a href="{{ route('pizzas.edit', [$pizza->id]) }}"
                                    class="btn btn-md btn-info text-white col"> Editar </a>
                            </div>
                            <div class="col-md-4 text-center">
                                <button type="submit" value="" class="btn btn-md btn-danger col"> Deletar </button>
                            </div>
                            @endrole
                            <div class="col-md-4 text-center">
                                <a href="{{ route('pizzas.index') }}" class="btn btn-md btn-dark text-white col"> Voltar
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
