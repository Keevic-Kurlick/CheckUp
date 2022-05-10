@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/menu/about.css') }}">
@endsection

@section('content')
    <div class="container about" style="">
        <div class="card about_main_block">
            <div class="card-body">
                <div class="about_main_block-logo">
                    <h5>
                        <img alt="logo" src={{ asset('storage/logos/largelogo.svg') }} >
                    </h5>
                </div>
                <div class="about_main_block-logo-subtext d-flex justify-content-center">
                    <h5 class="lead">Веб-сервис по оформлению
                        медицинских справок</h5>
                </div>

                <hr class="my-4 about_main_block-line">
                <div class="about_main_block-description d-flex justify-content-center">
                    <ul style="list-style-image:url('{{ asset('storage/logos/check-circle.svg') }}')">
                        Наш сервис - это:
                        <li>Быстрое и дистанционное оформление медицинских справок</li>
                        <li>Проверка анализов высококвалифированными специалистами</li>
                        <li>Передовые технологии в медицинском обслуживании</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
