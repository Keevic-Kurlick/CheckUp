@extends('admin.base_admin_template')

@section('title', __('admin.menu.medical_certificates'))

@section('content_header')
    <h1> {{ __('admin.menu.medical_certificates') }}</h1>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/admin/medical_certificates/index.css') }}">
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/admin/medical_certificates/destroy.js') }}"></script>
    <script>
        window.csrfToken = @json(csrf_token())
    </script>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.medical_certificates.create') }}" class="btn btn-success">{{ __('elements.buttons.add') }}</a>
        @include('admin.medical_certificates._table_index')
    </div>
@endsection