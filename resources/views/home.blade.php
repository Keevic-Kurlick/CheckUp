@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;">{{ __('Добро пожаловать!') }}</div>

                @if(Auth::user()->role->name === \App\Models\Role::ROLE_PATIENT)

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Вы авторизованы! Теперь вы можете заказывать справки, отслеживать статусы заказов, добавлять и изменять документы в личном кабинете.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
