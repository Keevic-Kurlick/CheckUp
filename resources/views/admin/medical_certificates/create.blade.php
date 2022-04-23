@php
/**
 * @var array $medicalCertificateTemplateParams
*/
@endphp

@extends('admin.base_admin_template')

@section('title', __('admin.medical_certificates.titles.create'))

@section('content_header')
    <h1> {{ __('admin.medical_certificates.titles.create') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="create-medical_certificate">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.medical_certificates.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="medical_certificate_name">{{ __('admin.medical_certificates.pages.create.medical_certificate_name') }}</label>
                                    <input class="form-control @error('medical_certificate_name') is-invalid @enderror"
                                           type="text"
                                           id="medical_certificate_name"
                                           name="medical_certificate_name"
                                           value="{{ old('medical_certificate_name') ?? ''}}">

                                    <x-show-error field-name="medical_certificate_name" />
                                </div>

                                <div class="form-group">
                                    <label for="medical_certificate_description">{{ __('admin.medical_certificates.pages.create.medical_certificate_description') }}</label>
                                    <textarea class="form-control @error('medical_certificate_description') is-invalid @enderror"
                                              type="text"
                                              id="medical_certificate_description"
                                              name="medical_certificate_description">
                                {{ old('medical_certificate_description') ?? ''}}
                            </textarea>
                                    <x-show-error field-name="medical_certificate_description" />
                                </div>
                            </div>

                            <div class="card col-6">
                                <div class="form-group">
                                    <label for="medical_certificate_template">{{ __('admin.medical_certificates.pages.create.medical_certificate_template') }}</label>
                                    <input type="file" class="form-control-file" id="medical_certificate_template">
                                    <x-show-error field-name="medical_certificate_description" />
                                </div>
                                <div class="template-params">
                                    <p>{{ __('admin.medical_certificates.pages.create.medical_certificate_template_params') }}</p>
                                    @if(!empty($medicalCertificateTemplateParams))
                                        <ul>
                                            @foreach ($medicalCertificateTemplateParams as $medicalCertificateTemplateParamKey => $medicalCertificateTemplateParamName)
                                                <li>{{ $medicalCertificateTemplateParamKey }} - {{ $medicalCertificateTemplateParamName }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection