@php

/**
* @var \App\Models\Service[] $services
*/
@endphp

@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/layouts/menu/services.css') }}" rel="stylesheet">
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class = "container" style="margin-bottom: 180px; align-content:center;justify-content: space-between">
        <div class = "row">
            @foreach($services as $service)
                <div class="col-xl-3 col-lg-4 col-md-6 col-s-12">
                    <div class="card" style="width: 18rem; margin:10px">
                        <img class="card-img-top-green" src="{{asset('storage/logos/notes-svgrepo-com.svg')}}"
                             alt="Справка">
                        <div class="card-body">
                            <h5 class="card-title"
                                style="font-weight: bold; text-align: center">{{ $service->name }}</h5>
                            <p class="card-text">{{ $service->price }} руб.</p>
                            <div class="card-button-block">
                                <a href="{{ route('menu.services.show', $service->id) }}" class="btn btn-primary">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
