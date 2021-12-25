@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/layouts/menu/services.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class = "container" style="margin-bottom: 180px; align-content:center;justify-content: space-between">
        <div class = "row">
            <div class = "col-xl-3 col-lg-4 col-md-6 col-s-12">
                <div class="card" style="width: 18rem; margin:10px">
                    <img class="card-img-top-green" src="{{asset('storage/logos/notes-svgrepo-com.svg')}}" alt="Справка">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold; text-align: center">Справка 003/в-у</h5>
                        <p class="card-text">Справка для получения водительского удостоверения</p>
                        <p class="card-text">1500 руб.</p>
                        <a href="#" class="btn btn-primary" style="display:flex; justify-content: center;background-color:#00C98D; color:white; font-weight: bold">Заказать</a>
                    </div>
                </div>
            </div>
            <div class = "col-xl-3 col-lg-4 col-md-6 col-s-12">
                <div class="card" style="width: 18rem; margin:10px">
                    <img class="card-img-top-green" src="{{asset('storage/logos/notes-svgrepo-com.svg')}}" alt="Справка">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold; text-align: center">Справка 003/в-у</h5>
                        <p class="card-text">Справка для получения водительского удостоверения</p>
                        <p class="card-text">1500 руб.</p>
                        <a href="#" class="btn btn-primary" style="display:flex; justify-content: center;background-color:#00C98D; color:white; font-weight: bold">Заказать</a>
                    </div>
                </div>
            </div>
            <div class = "col-xl-3 col-lg-4 col-md-6 col-s-12">
                <div class="card" style="width: 18rem; margin:10px">
                    <img class="card-img-top-green" src="{{asset('storage/logos/notes-svgrepo-com.svg')}}" alt="Справка">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold; text-align: center">Справка 003/в-у</h5>
                        <p class="card-text">Справка для получения водительского удостоверения</p>
                        <p class="card-text">1500 руб.</p>
                        <a href="#" class="btn btn-primary"style="display:flex; justify-content: center;background-color:#00C98D; color:white; font-weight: bold">Заказать</a>
                    </div>
                </div>
            </div>
            <div class = "col-xl-3 col-lg-4 col-md-6 col-s-12">
                <div class="card" style="width: 18rem; margin:10px">
                    <img class="card-img-top-green" src="{{asset('storage/logos/notes-svgrepo-com.svg')}}" alt="Справка">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold; text-align: center">Справка 003/в-у</h5>
                        <p class="card-text">Справка для получения водительского удостоверения</p>
                        <p class="card-text">1500 руб.</p>
                        <a href="#" class="btn btn-primary"style="display:flex; justify-content: center;background-color:#00C98D; color:white; font-weight: bold">Заказать</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
