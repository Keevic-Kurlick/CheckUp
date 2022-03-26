@extends('admin.base_admin_template')

@section('title', __('admin.menu.services'))

@section('content_header')
    <h1> {{ __('admin.menu.services') }}</h1>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/admin/services/index.css') }}">
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/admin/services/destroy.js') }}"></script>
    <script>
        window.csrfToken = @json(csrf_token())
    </script>
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.services.create') }}" class="btn btn-success">Добавить</a>
        @include('admin.services._table_index')
    </div>
@endsection