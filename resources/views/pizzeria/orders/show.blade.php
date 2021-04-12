@extends('layouts.app')
@section('content')
    <div class="col d-flex justify-content-center">
        <div class="col-8">
            <div class="row card-header text-center">
                <div class="row  my-2">
                    <h2> Pedido de: {{ $order['name'] }}</h2>
                </div>

                <div class="row  d-flex justify-content-center my-2">
                    <img src="{{ asset('storage/' . $order['photo']) }}" style="max-width: 150px; max-height: 150px;"
                        alt="photo">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center mb-5">
                        <div class="col-md-3 text-center">
                            <h3>Endereço</h3>
                            <hr>
                            <span>{{ $order['address'] }}</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3>CPF</h3>
                            <hr>
                            <span>{{ $order['cpf'] }}</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3>Sabor</h3>
                            <hr>
                            <span>{{ $order['flavour'] }}</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 text-center card-header">
                            <h3>Valor cobrado: R${{ $order['price'] }}</h3>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center my-3">
                        <div class="col-md-3 text-center">
                            <a href="{{ route('orders.edit', [$order['id']]) }}"
                                class="text-white btn btn-md btn-info col">
                                Editar </a>
                        </div>
                        <div class="col-md-4 text-center">
                            {!! Form::open()->delete()->route('orders.destroy', [$order['id']]) !!}
                            <button type="submit" value="" class="btn btn-md btn-danger col"> Deletar </button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-3 text-center">
                            <a href="{{ route('orders.index') }}" class="btn btn-md btn-dark text-white col"> Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
