@extends('layouts.app')
@section('content')
<div class="col d-flex justify-content-center">
    <div class="col-6">
        <h2 class="text-center card-header">
            {{'Cliente: '.$client->name}}
        </h2>
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-md-5 text-center">
                        <h3>Nome</h3>
                        <hr>
                        <span>{{$client->name}}</span>
                    </div>
                    <div class="col-md-5 text-center">
                        <h3>CPF</h3>
                        <hr>
                        <span>{{$client->cpf}}</span>
                    </div>
                </div> 
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 text-center card-header">
                        <h3>Foto</h3>
                        <hr>
                        <img src="{{asset('storage/'.$client->photo)}}" alt="photo" style="max-width: 500px; max-height: 500px;">
                    </div>
                    {!!Form::open()->delete()->route('clients.destroy',[$client->id])!!}
                        <div class="row d-flex justify-content-center mt-3">                       
                            <div class="col-md-4 text-center">
                                <a href="{{route('clients.edit',[$client->id])}}" class="btn btn-md btn-info text-white col"> Editar </a>
                            </div>
                            <div class="col-md-4 text-center">
                                <button type="submit" value="" class="btn btn-md btn-danger col"> Deletar </button>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="{{route('clients.index')}}" class="btn btn-md btn-dark text-white col"> Voltar </a>
                            </div>                          
                        </div>  
                    {!!Form::close()!!}                       
                </div>
            </div>
        </div>
    </div>
</div>

@endsection