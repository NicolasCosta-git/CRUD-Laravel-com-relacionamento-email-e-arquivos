<div class="d-flex justify-content-center">
    <div class="col-8">
        <div class="row">
            <div class="col-md-6">
                {!! Form::select('client_id','Clientes')->options($clients->prepend('Selecione o cliente...', '')) !!}
            </div>
            <div class="col-md-6">
                {!! Form::select('pizza_id','Pizzas')->options($pizzas->prepend('Selecione a pizza...', ''), 'flavour')!!}
            </div>
        </div>
        <div class="row d-flex justify-content-center my-3">
            <div class="col-6 text-center">
                <a href="{{route('orders.index')}}" class="btn btn-lg btn-dark text-white col-8"> Voltar </a>
            </div>
            <div class="col-6 text-center">
                <button type="submit" class="btn btn-lg btn-success col-8"> Salvar </button>
            </div>
        </div>
    </div>
</div>
