@extends('layouts.app')

@section('content')
<div class = "register">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style = "font-size: 18px; text-align: center; background-color: #00866E; color: white; font-weight: bolder;">{{ __('Регистрация') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="agree-user-policy"
                                           id="agree-user-policy">
                                    <label class="form-check-label" for="agree-user-policy">
                                        Я принимаю <a href="">Пользовательское соглашение</a>
                                    </label>
                                </div>

                                <x-show-error field-name="agree-user-policy" />

                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="agree-privacy-policy"
                                           id="agree-privacy-policy">
                                    <label class="form-check-label" for="agree-privacy-policy">
                                        Я принимаю <a href="">Политику конфиденциальности</a>
                                    </label>
                                </div>

                                <x-show-error field-name="agree-privacy-policy" />
                            </div>

                            <div class="row mb-0" style = "justify-content: center">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" style = "align-content: center; background-color:#00C98D; color:white; font-size: 18px; font-weight: bold">
                                        {{ __('Зарегистрироваться') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
