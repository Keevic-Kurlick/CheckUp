@extends('layouts.app')

@section('content')
    <div class="container" style="height:100%; margin-bottom: 170px">
        <div class="card text-center" style="width: 100%;">
            <div class="card-body">
                <h5><img src= {{asset('storage/logos/largelogo.svg')}}></h5>
                <h5 class="lead" style="font-size: 24px; color:#9e9e9e; font-weight: bold">Веб-сервис по оформлению
                    медицинских справок</h5>
                <hr class="my-4">
                <div class="wrapper" style="justify-content: center">
                    <ul style="font-size: 30px; color:#4c4c4c; display: block; list-style-image:url('../../../../storage/app/public/Logos/check-circle.svg')">
                        Наш сервис - это:
                        <li>Легальное, быстрое и дистанционное оформление 4 медицинских справок</li>
                        <li>Проверка анализов высококвалифированными специалистами</li>
                        <li>Передовые технологии в медицинском обслуживании</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection