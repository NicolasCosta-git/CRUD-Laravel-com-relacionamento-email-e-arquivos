@extends('layouts.app')
@section('content')
<div class="col d-flex justify-content-center">
    <div class="col-12">
        <h2 class="text-center card-header">
            Pedido de: {{$order['name']}}
        </h2>
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-md-3 text-center">
                        <h3>Cliente</h3>
                        <hr>
                        <span>{{$order['flavour']}}</span>
                    </div>
                    <div class="col-md-3 text-center">
                        <h3>CPF</h3>
                        <hr>
                        <span>{{$order['cpf']}}</span>
                    </div>
                    <div class="col-md-3 text-center">
                        <h3>Sabor</h3>
                        <hr>
                        <span>{{$order['flavour']}}</span>
                    </div>
                </div> 
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 text-center card-header">
                        <h3>Valor cobrado: R${{$order['price']}}</h3>
                    </div>
                    {!!Form::open()->delete()->route('orders.destroy',[$order['id']])!!}
                        <div class="row d-flex justify-content-center mt-3">                       
                            <div class="col-md-4 text-center">
                                <a href="{{route('orders.edit',[$order['id']])}}" class="btn btn-md btn-info text-white col"> Editar </a>
                            </div>
                            <div class="col-md-4 text-center">
                                <button type="submit" value="" class="btn btn-md btn-danger col"> Deletar </button>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="{{route('orders.index')}}" class="btn btn-md btn-dark text-white col"> Voltar </a>
                            </div>                          
                        </div>  
                    {!!Form::close()!!}                       
                </div>
            </div>
        </div>
    </div>
</div>


   
@endsection