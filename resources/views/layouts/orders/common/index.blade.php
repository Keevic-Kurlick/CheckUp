@php
/**
 * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $orders
 */
@endphp

@extends('layouts.app')

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')

    <div class="container">
        @include('layouts.orders.common._table')
    </div>

@endsection