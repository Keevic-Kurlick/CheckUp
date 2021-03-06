@php
    /**
    * @var \App\Models\Service $service
    * @var \App\Models\User    $user
    */
@endphp

@extends('layouts.app')

@section('js')
    @parent
    <script src="{{ asset('js/elements/input_masks.js') }}" defer></script>
@endsection

@section('content')
    <div class = "container" style="margin-bottom: 180px; align-content:center;justify-content: space-between">
        <div class = "row">
            @cannot('hasAccessToOrderService', \App\Models\User::class)
                @guest
                    <div class="col-12">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            Для оформления медицинской справки, необходимо
                            <a href="{{ route('login') }}" class="alert-link">
                                авторизоваться
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endguest

                @auth
                    @if($user->patientInformation?->check_status === \App\Models\PatientInformation::CHECK_STATUS_NEED_CONFIRM)
                        <div class="col-12">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <span>
                                    Для оформления медицинской справки необходимо обратиться в медицинскую организацию
                                    для подтверждения данных Ваших документов.
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @empty($user->patientInformation)
                        <div class="col-12">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <span>
                                Для оформления медицинской справки необходимо заполнить данные
                                в разделе &#171;Документы&#187;.
                            </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endempty
                @endauth
            @endcannot
            <div class="col-sm-12
                    @can('hasAccessToOrderService', \App\Models\User::class)
                        col-md-6 mb-2
                    @endcan">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $service->name }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="service-description">{{ $service->description }}</p>
                    </div>
                    <div class="card-footer">
                        <p>{{ $service->price }} руб.</p>
                    </div>
                </div>
            </div>
            @can('hasAccessToOrderService', \App\Models\User::class)
                <div class="col-sm-12 col-md-6 mb-2">
                    <form class="card" method="post" action="{{ route('menu.services.order.create', $service->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Данные для оформления</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <div class="col-12">
                                    <label for="passport_series" class="form-label">Серия паспорта</label>
                                    <input type="text"
                                           class="form-control input-passport-series"
                                           id="passport_series"
                                           placeholder="Серия паспорта"
                                           value="{{ old('passport_series', $user?->patientInformation?->passport_series ?? null)  }}"
                                           name="passport_series"
                                           readonly
                                    >

                                    <x-show-error field-name="passport_series" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-12">
                                    <label for="passport_number" class="form-label">Номер паспорта</label>
                                    <input type="text"
                                           class="form-control input-passport-number"
                                           id="passport_number"
                                           placeholder="Номер паспорта"
                                           value="{{ old('passport_number', $user?->patientInformation?->passport_number ?? null)  }}"
                                           name="passport_number"
                                           readonly
                                    >

                                    <x-show-error field-name="passport_number" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-12">
                                    <label for="patient_inn" class="form-label">ИНН</label>
                                    <input type="text"
                                           class="form-control input-inn"
                                           id="patient_inn"
                                           placeholder="ИНН"
                                           value="{{ old('patient_inn', $user?->patientInformation?->inn ?? null)  }}"
                                           name="patient_inn"
                                           readonly
                                    >

                                    <x-show-error field-name="patient_inn" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-12">
                                    <label for="patient_snils" class="form-label">СНИЛС</label>
                                    <input type="text"
                                           class="form-control input-snils"
                                           id="patient_snils"
                                           placeholder="СНИЛС"
                                           value="{{ old('patient_snils', $user?->patientInformation?->snils ?? null)  }}"
                                           name="patient_snils"
                                           readonly
                                    >
                                </div>

                                <x-show-error field-name="patient_snils" />
                            </div>

                            <div class="form-group row mb-3">
                                <label for="patient_passport_scan" class="form-label">Скан паспорта</label>
                                <input type="file" class="form-control-file"
                                       name="patient_passport_scan" id="patient_passport_scan"
                                       value="{{ old('patient_passport_scan') ?? null }}">

                                <x-show-error field-name="patient_passport_scan" />
                            </div>

                            <div class="form-group row mb-3">
                                <label for="patient_analysis_scan" class="form-label">Скан анализов</label>
                                <input type="file" class="form-control-file"
                                       name="patient_analysis_scan" id="patient_analysis_scan"
                                       value="{{ old('patient_analysis_scan') ?? null }}">

                                <x-show-error field-name="patient_analysis_scan" />
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" value="Оформить">
                        </div>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endsection
