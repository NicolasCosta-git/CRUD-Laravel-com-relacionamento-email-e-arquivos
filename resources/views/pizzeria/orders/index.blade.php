@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <h2 class="col text-center">Pedidos</h2>
                    <hr>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 text-center my-4">
                        <a href="{{ route('orders.create') }}" class="btn btn-lg btn-success">Fazer pedido</a>
                    </div>
                    <div class="col-md-3 my-4 text-center">
                        <a class="btn btn-lg btn-secondary" href="{{ route('pizzeria') }}">Voltar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="">
                    <table class=" table table-striped" align="center">
                        <thead class="table-dark" align="center">
                            <tr>
                                @role('super_admin')
                                <th>Cliente</th>
                                @endrole
                                <th>Pizza</th>
                                <th>Preço</th>
                                <th></th>
                                @role('super_administrador')
                                <th></th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody align="center">
                            @forelse ($orders as $order)
                                <tr>
                                    @role('super_administrador')
                                    <td style="vertical-align: middle">{{ $order->users->name }}</td>
                                    @endrole
                                    <td style="vertical-align: middle">{{ $order->pizzas->flavour }}</td>
                                    <td style="vertical-align: middle">{{ $order->pizzas->price }}</td>
                                    <td style="vertical-align: middle">
                                        {!! Form::open()->delete()->route('orders.destroy', [$order->id]) !!}
                                        @role('super_administrador')
                                        <a href="{{ route('orders.edit', [$order->id]) }}"
                                            class="btn btn-md btn-info text-white"> Editar </a>
                                        <button type="submit" value="" class="btn btn-md btn-danger"> Deletar </button>
                                        @endrole
                                        <a href="{{ route('orders.show', [$order->id]) }}"
                                            class="btn btn-md btn-dark text-white"> Ver </a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100"> Não existem pedidos registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endsection
