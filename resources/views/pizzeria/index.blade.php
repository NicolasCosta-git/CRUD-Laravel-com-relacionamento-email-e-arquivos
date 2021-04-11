@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 my-2 my-md-0">
                <div class="card align-items-center">
                    <div class="card-body">
                        <a href="{{route('pizzas.index')}}" class="btn"> <img src="{{ url('/img/Pizza-icon.png') }}" style="max-width: 200px;" alt="Pizzas">
                            <h3 class="text-center my-2">Pizzas</h3>
                        </a>
                    </div>
                </div>
            </div>
            @role('super_administrador')
            <div class="col-lg-3 col-md-4 my-2 my-md-0">
                <div class="card align-items-center">
                    <div class="card-body">
                        <a href="{{route('clients.index')}}" class="btn"> <img src="{{ url('/img/customer-icon.png') }}" style="max-width: 200px;" alt="Cliente">
                            <h3 class="text-center my-2">Clientes</h3>
                        </a>
                    </div>
                </div>
            </div>
            @endrole
            <div class="col-lg-3 col-md-4 my-2 my-md-0">
                <div class="card align-items-center">
                    <div class="card-body ">
                        <a href="{{route('orders.index')}}" class="btn"> <img src="{{ url('/img/pack-pizza.png') }}" style="max-width: 200px;" alt="Pedidos">
                            <h3 class="text-center my-2">Pedidos</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
