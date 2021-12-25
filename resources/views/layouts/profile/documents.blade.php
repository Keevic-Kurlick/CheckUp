@section('css')
    <link href="{{ asset('css/layouts/profile/documents.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
    <div class="container documents">
        <p style="font-size: 16px; text-align: center"> Данные документов необходимы для оформления заказов</p>
        <form>
            <div class="form-group row">
                <label for="inputPassportSeries" class="col-sm-2 col-form-label">Серия паспорта</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPassportSeries" placeholder="Серия паспорта">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassportNumber" class="col-sm-2 col-form-label">Номер паспорта</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPassportNumber" placeholder="Номер паспорта">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputInn" class="col-sm-2 col-form-label">ИНН</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputInn" placeholder="ИНН">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputSnils" class="col-sm-2 col-form-label">СНИЛС</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputSnils" placeholder="СНИЛС">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button class="btn btn-primary" style="display:flex;color:white;font-weight: bold;background-color:#00C98D">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

