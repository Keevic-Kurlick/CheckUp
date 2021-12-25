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
    <script src="{{ asset('js/menu/services.js') }}"
            id="services"
            data-services='@json($services)'
            defer>
    </script>
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
                                <button class="btn btn-primary orderButton"
                                        data-toggle="modal"
                                        data-target="#servicesModal"
                                        data-service-id="{{ $service->id }}">
                                    Подробнее
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="servicesModal" tabindex="-1" role="dialog" aria-labelledby="servicesModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="service-description">

                    </div>
                    <div class="service-price-block">
                        <p>
                            Цена: <span id="service-price"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('menu.orders.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="serviceId">
                        <input type="submit" class="btn btn-primary" value="Заказать">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
