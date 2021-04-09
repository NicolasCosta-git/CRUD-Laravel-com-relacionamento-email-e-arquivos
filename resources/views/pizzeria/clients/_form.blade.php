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
                {!! Form::text('name', '<h5> Nome </h5>') !!}
            </div>
            <div class="col-md-6">
                {!! Form::text('cpf', '<h5> CPF </h5>')->type('number') !!}
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <h5 class="text-center my-2">Foto do cliente</h5>
            <div class="col-md-8 d-flex mb-4 justify-content-center">
                <label for="input-photo" class="form-label"></label>
                <input type="file" class="form-control" id="input-photo" name="photo">
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 text-center">
                <a href="{{ route('clients.index') }}" class="btn btn-lg btn-dark text-white col-8"> Voltar </a>
            </div>
            <div class="col-6 text-center">
                <button type="submit" class="btn btn-lg btn-success col-8"> Salvar </button>
            </div>
        </div>
    </div>
</div>
