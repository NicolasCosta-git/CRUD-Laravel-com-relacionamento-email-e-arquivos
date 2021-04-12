@extends('layouts.app')
@section('content')
    <div class="col d-flex justify-content-center">
        <div class="col-6">
            <h2 class="text-center card-header">
                {{ 'Cliente: ' . $user->name }}
            </h2>
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center mb-5">
                        <div class="col-md-5 text-center">
                            <h3>Nome</h3>
                            <hr>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="col-md-5 text-center">
                            <h3>CPF</h3>
                            <hr>
                            <span>{{ $user->cpf }}</span>
                        </div>
                        <div class="col-md-5 text-center my-3">
                            <h3>Endereço</h3>
                            <hr>
                            <span>{{ $user->address }}</span>
                        </div>
                        <div class="col-md-5 text-center my-3">
                            <h3>E-mail</h3>
                            <hr>
                            <span>{{ $user->email }}</span>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 text-center card-header">
                            <h3>Foto</h3>
                            <hr>
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="photo"
                                style="max-width: 500px; max-height: 500px;">
                        </div>
                        <div class="col-md-4 text-center mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-md btn-dark text-white col"> Voltar </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
