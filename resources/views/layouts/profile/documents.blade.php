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
                           name="passport_series">
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
                           name="passport_number">
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
                           name="patient_snils">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary"
                            style="display:flex;color:white;font-weight: bold;background-color:#00C98D" value="Сохранить">
                </div>
            </div>
        </form>
    </div>
@endsection
