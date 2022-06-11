@extends('admin.base_admin_template')

@section('title', __('admin.menu.check_documents'))

@section('content_header')
    <h1> {{ __('admin.menu.check_documents') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class="container">
        @include('admin.documents.check_documents._filter_index')
        @include('admin.documents.check_documents._table_index')
    </div>
@endsection
