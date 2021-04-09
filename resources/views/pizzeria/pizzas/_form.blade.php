@if(Session::has('error'))
    <div class="col d-flex justify-content-center">
        <div class="col-md-6 alert alert-warning alert-dismissible fade show col text-center" role="alert">
        {{Session::get('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
@endif
<div class="d-flex justify-content-center">
    <div class="col-8">
        <div class="row">
            <div class="col-md-6">
                {!! Form::text('flavour', '<h5> Sabor </h5>') !!}
            </div>
            <div class="col-md-6">
                {!! Form::text('price', '<h5> Preço </h5>')->type('number') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::textarea('ingredients', '<h5> Escreva aqui os ingredientes da pizza </h5>') !!}
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 text-center">
                <a href="{{route('pizzas.index')}}" class="btn btn-lg btn-dark text-white col-8"> Voltar </a>
            </div>
            <div class="col-6 text-center">
                <button type="submit" class="btn btn-lg btn-success col-8"> Salvar </button>
            </div>
        </div>
    </div>
</div>
