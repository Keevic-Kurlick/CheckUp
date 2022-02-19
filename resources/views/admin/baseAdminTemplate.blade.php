@extends('adminlte::page')

@section('css')
    @toastr_css
    <link href="{{ asset('css/elements.css') }}" rel="stylesheet">
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection