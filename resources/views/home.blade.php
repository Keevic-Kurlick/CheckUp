@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 18px; text-align: center; background-color: #00866E; color: white; font-weight: bolder;">{{ __('Добро пожаловать!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Вы авторизованы! Теперь вы можете заказывать справки, отслеживать статусы заказов, добавлять и изменять документы в личном кабинете.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
