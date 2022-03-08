@extends('admin.base_admin_template')

@section('title', __('admin.menu.services'))

@section('content_header')
    <h1> {{ __('admin.menu.services') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.services.create') }}" class="btn btn-success">Добавить</a>
        @include('admin.services._table_index')
    </div>
@endsection