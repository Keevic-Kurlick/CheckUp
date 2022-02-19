@extends('adminlte::page')

@section('css')
    @toastr_css
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection