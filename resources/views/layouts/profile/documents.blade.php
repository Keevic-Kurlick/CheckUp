@extends('layouts.app')

@section('content')
    <div class="container" style="color:gray">
        <p style="font-size: 16px; text-align: center"> Данные документов необхрдимы для оформления заказов</p>
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
{{--            <fieldset class="form-group">--}}
{{--                <div class="row">--}}
{{--                    <legend class="col-form-label col-sm-2 pt-0">Radios</legend>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>--}}
{{--                            <label class="form-check-label" for="gridRadios1">--}}
{{--                                First radio--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">--}}
{{--                            <label class="form-check-label" for="gridRadios2">--}}
{{--                                Second radio--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check disabled">--}}
{{--                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>--}}
{{--                            <label class="form-check-label" for="gridRadios3">--}}
{{--                                Third disabled radio--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </fieldset>--}}
{{--            <div class="form-group row">--}}
{{--                <div class="col-sm-2">Checkbox</div>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="checkbox" id="gridCheck1">--}}
{{--                        <label class="form-check-label" for="gridCheck1">--}}
{{--                            Example checkbox--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
