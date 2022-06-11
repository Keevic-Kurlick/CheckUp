@php
    /**
     * @var \App\Models\User $user
     */
@endphp

@extends('admin.base_admin_template')

@section('title', __('admin.check_documents.titles.edit'))

@section('content_header')
    <h1> {{ __('admin.check_documents.titles.edit') }}</h1>
@endsection

@section('css')
    @parent
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/elements/input_masks.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="edit-documents">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <form action="{{ route('admin.users.documents.check.confirm', $user->id) }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="card">
                            <div class="card-header">
                                <h4> {{$user->name}} </h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="passport_series">
                                        {{ __('admin.check_documents.pages.edit.passport_series') }}
                                    </label>
                                    <input class="form-control @error('passport_series') is-invalid @enderror
                                            input-passport-series"
                                           type="text"
                                           id="passport_series"
                                           name="passport_series"
                                           value="{{ $user->patientInformation->passport_series }}">

                                    <x-show-error field-name="passport_series" />
                                </div>

                                <div class="form-group">
                                    <label for="passport_number">
                                        {{ __('admin.check_documents.pages.edit.passport_number') }}
                                    </label>
                                    <input class="form-control @error('passport_number') is-invalid @enderror
                                            input-passport-number"
                                           type="text"
                                           id="passport_number"
                                           name="passport_number"
                                           value="{{ $user->patientInformation->passport_number }}">

                                    <x-show-error field-name="passport_number" />
                                </div>

                                <div class="form-group">
                                    <label for="inn">
                                        {{ __('admin.check_documents.pages.edit.inn') }}
                                    </label>
                                    <input class="form-control @error('inn') is-invalid @enderror
                                            input-inn"
                                           type="text"
                                           id="inn"
                                           name="inn"
                                           value="{{ $user->patientInformation->inn }}">

                                    <x-show-error field-name="inn" />
                                </div>

                                <div class="form-group">
                                    <label for="snils">
                                        {{ __('admin.check_documents.pages.edit.snils') }}
                                    </label>
                                    <input class="form-control @error('snils') is-invalid @enderror
                                            input-snils"
                                           type="text"
                                           id="snils"
                                           name="snils"
                                           value="{{ $user->patientInformation->snils }}">

                                    <x-show-error field-name="snils" />
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('admin.check_documents.pages.edit.btn_confirm') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
