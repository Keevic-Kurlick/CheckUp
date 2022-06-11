@php
    /**
    * @var \App\Models\PatientInformation $patientInformation
    */

    $isPatientInformationExist = isset($patientInformation);
    $isNeedConfirm = $patientInformation?->check_status === \App\Models\PatientInformation::CHECK_STATUS_NEED_CONFIRM;
@endphp

@section('css')
    <link href="{{ asset('css/layouts/profile/documents.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('js/elements/input_masks.js') }}" defer></script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container documents">
        <h1 class="form-header"> Данные документов необходимы для оформления заказов</h1>
        <form action="{{ route('profile.documents.store') }}" method=post>
            @csrf
            <div class="form-group row">
                <label for="inputPassportSeries" class="col-sm-2 col-form-label">Серия паспорта</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control input-passport-series"
                           id="inputPassportSeries"
                           placeholder="Серия паспорта"
                           value="{{ old('passport_series', $patientInformation->passport_series?? null)  }}"
                           name="passport_series"
                           @if($isPatientInformationExist)
                            readonly
                           @endif
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassportNumber" class="col-sm-2 col-form-label">Номер паспорта</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control input-passport-number"
                           id="inputPassportNumber"
                           placeholder="Номер паспорта"
                           value="{{ old('passport_number', $patientInformation->passport_number?? null)  }}"
                           name="passport_number"
                           @if($isPatientInformationExist)
                            readonly
                           @endif
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputInn" class="col-sm-2 col-form-label">ИНН</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control input-inn"
                           id="inputInn"
                           placeholder="ИНН"
                           value="{{ old('patient_inn', $patientInformation->inn?? null)  }}"
                           name="patient_inn"
                           @if($isPatientInformationExist)
                            readonly
                           @endif
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputSnils" class="col-sm-2 col-form-label">СНИЛС</label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control input-snils"
                           id="inputSnils"
                           placeholder="СНИЛС"
                           value="{{ old('patient_snils', $patientInformation->snils?? null)  }}"
                           name="patient_snils"
                           @if($isPatientInformationExist)
                            readonly
                           @endif
                    >
                </div>
            </div>

            @if(empty($isPatientInformationExist))
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary"
                               style="display:flex;color:white;font-weight: bold;background-color:#00C98D" value="Сохранить">
                    </div>
                </div>
            @endif

            @if($isNeedConfirm)
                <div class="row mt-3">
                    <p class="col-12 text-danger fw-bold">
                        <span>Достоверность данных не установлена!</span><br>
                        <span>Подача заявок на оформление справок невозможна.</span><br>
                        <span>Для установления достоверности данных обратитесь в медицинскую организацию.</span>
                    </p>
                </div>
            @elseif($isPatientInformationExist && empty($isNeedConfirm))
                <div class="row mt-3">
                    <p class="col-12 text-gray">
                        <span class="text-decoration-underline">Достоверность данных подтверждена.</span><br>
                        <span>Для изменения данных обратитесь в медицинскую организацию.</span>
                    </p>
                </div>
            @endif
        </form>
    </div>
@endsection
