@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        {!! Form::open()->post()->route('register')->multipart() !!}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required title="Preencha o campo de nome"
                                    autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required title="Preencha o campo de email"
                                    autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf-input"
                                class="col-md-4 col-form-label text-md-right">{{ 'CPF' }}</label>

                            <div class="col-md-6">
                                <input id="cpf-input" type="number" class="form-control" name="cpf"
                                    value="{{ old('cpf') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address-input"
                                class="col-md-4 col-form-label text-md-right">{{ 'Endereço' }}</label>

                            <div class="col-md-6">
                                <input id="address-input" type="text" class="form-control" name="address"
                                    value="{{ old('address') }}" required>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8 d-flex mb-4 justify-content-center">
                                <label for="input-photo" class="form-label">
                                    <p class="pr-3">Foto</p>
                                </label>
                                <input type="file" class="form-control" id="input-photo" name="photo" required>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-6 text-center">
                                <button type="submit" class="btn btn-lg btn-success col-8"> Cadastrar </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
