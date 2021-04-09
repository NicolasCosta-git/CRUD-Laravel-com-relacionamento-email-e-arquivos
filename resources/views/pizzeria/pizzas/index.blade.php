@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <h2 class="col text-center">Pizzas</h2>
                    <hr>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 text-center my-4">
                        <a href="{{ route('pizzas.create') }}" class="btn btn-lg btn-success">Adicionar pizzas</a>
                    </div>
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
                                <th>Sabor</th>
                                <th>Preço</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @forelse ($data as $pizza)
                            <tr>
                                <td style="vertical-align: middle">{{ $pizza->flavour }}</td>
                                <td style="vertical-align: middle">{{ $pizza->price }}</td>
                                <td style="vertical-align: middle">
                                    {!! Form::open()->delete()->route('pizzas.destroy', [$pizza->id]) !!} 
                                    <a href="{{route('pizzas.edit',[$pizza->id])}}" class="btn btn-md btn-info text-white"> Editar </a>
                                    <button type="submit" value="" class="btn btn-md btn-danger"> Deletar </button>
                                    <a href="{{route('pizzas.show', [$pizza->id])}}" class="btn btn-md btn-dark text-white"> Ver </a>
                                    {!! Form::close() !!}
                                </td>   
                            </tr>   
                            @empty
                                <tr>
                                    <td colspan="100"> Não existem pizzas registradas </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @endsection
