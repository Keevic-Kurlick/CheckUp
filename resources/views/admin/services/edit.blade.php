@php
    /**
    * @var array $service
    * @var \App\Models\MedicalCertificate[] $medicalCertificates
    */
@endphp

@extends('admin.base_admin_template')

@section('title', __('admin.services.titles.services_edit'))

@section('content_header')
    <h1> {{ __('admin.services.titles.services_edit') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="edit-services">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.services.update', $service['id']) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="service_name">{{ __('admin.services.pages.create.service_name') }}</label>
                            <input class="form-control @error('service_name') is-invalid @enderror"
                                   type="text"
                                   id="service_name"
                                   name="service_name"
                                   value="{{ $service['name'] }}">

                            <x-show-error field-name="service_name" />
                        </div>

                        <div class="form-group">
                            <label for="service_description">{{ __('admin.services.pages.create.service_description') }}</label>
                            <textarea class="form-control @error('service_description') is-invalid @enderror"
                                      id="service_description"
                                      name="service_description">
                                {{ $service['description'] }}
                            </textarea>
                            <x-show-error field-name="service_description" />
                        </div>

                        <div class="form-group">
                            <label for="service_medical_certificate">
                                {{ __('admin.services.pages.edit.service_medical_certificate.label') }}
                            </label>
                            @if(empty($medicalCertificates))
                                {{ __('admin.services.pages.edit.service_medical_certificate.empty') }}
                            @else
                                <select name="service_medical_certificate"
                                        class="form-control"
                                        id="service_medical_certificate">
                                    <option value=""
                                            @if(empty(old('service_medical_certificate')))
                                            selected
                                            @endif>
                                        Выберите справку...
                                    </option>

                                    @foreach($medicalCertificates as $medicalCertificate)
                                        <option value="{{ $medicalCertificate->id }}"
                                                @if(
                                                    old('service_medical_certificate') == $medicalCertificate->id
                                                    || $service['medical_certificate']['id'] == $medicalCertificate->id
                                                )
                                                    selected
                                                @endif>
                                            {{ $medicalCertificate['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                            <x-show-error field-name="service_medical_certificate" />
                        </div>

                        <div class="form-group">
                            <label for="service_price">{{ __('admin.services.pages.create.service_price') }}</label>
                            <input class="form-control @error('service_price') is-invalid @enderror"
                                   type="number"
                                   id="service_price"
                                   name="service_price"
                                   value="{{ $service['price'] }}"
                            >

                            <x-show-error field-name="service_price" />
                        </div>

                        <input type="submit" class="btn btn-success" value="Изменить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection