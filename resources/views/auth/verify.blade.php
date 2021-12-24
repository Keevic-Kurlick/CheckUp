@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style = "font-size: 18px; text-align: center; background-color: #00866E; color: white; font-weight: bolder;">{{ __('Подтверждение E-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ссылка для подтверждения была отправлена на Вашу почту.') }}
                        </div>
                    @endif

                    {{ __('Перед работой перейдите по ссылке из письма для подтверждения E-mail') }}
                    {{ __('Не пришло письмо?') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" style="background-color:#00C98D; color:white; font-size: 18px; font-weight: bold" class="btn btn-link p-0 m-0 align-baseline">{{ __('Отправить ещё раз') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
