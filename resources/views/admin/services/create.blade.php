@extends('admin.base_admin_template')

@section('title', __('admin.services.titles.services_create'))

@section('content_header')
    <h1> {{ __('admin.services.titles.services_create') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="create-services">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.services.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="service_name">{{ __('admin.services.pages.create.service_name') }}</label>
                            <input class="form-control @error('service_name') is-invalid @enderror"
                                   type="text"
                                   id="service_name"
                                   name="service_name"
                                   value="{{ old('service_name') ? old('service_name') : ''}}">

                            <x-show-error field-name="service_name" />
                        </div>

                        <div class="form-group">
                            <label for="service_description">{{ __('admin.services.pages.create.service_description') }}</label>
                            <textarea class="form-control @error('service_description') is-invalid @enderror"
                                      type="text"
                                      id="service_description"
                                      name="service_description">
                            </textarea>
                            <x-show-error field-name="service_description" />
                        </div>

                        <div class="form-group">
                            <label for="service_price">{{ __('admin.services.pages.create.service_price') }}</label>
                            <input class="form-control @error('service_price') is-invalid @enderror"
                                   type="number"
                                   id="service_price"
                                   name="service_price">

                            <x-show-error field-name="service_price" />
                        </div>

                        <input type="submit" class="btn btn-success" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection