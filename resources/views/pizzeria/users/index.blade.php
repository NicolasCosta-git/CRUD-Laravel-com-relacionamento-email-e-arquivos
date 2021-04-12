@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <h2 class="col text-center">Clientes</h2>
                    <hr>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 my-4 text-center col-md-4">
                        <a class="btn btn-lg btn-secondary" href="{{ route('pizzeria') }}">Voltar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="">
                    <table class=" table table-striped" align="center">
                        <thead class="table-dark" align="center">
                            <tr>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @forelse ($users as $user)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $user->photo) }}"
                                            style="max-width: 150px; max-height: 150px;" alt="photo"></td>
                                    <td style="vertical-align: middle">{{ $user->name }}</td>
                                    <td style="vertical-align: middle">{{ $user->cpf }}</td>
                                    <td style="vertical-align: middle">
                                        <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-md btn-dark text-white">
                                            Ver </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100">Não existem useres cadastrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @endsection
