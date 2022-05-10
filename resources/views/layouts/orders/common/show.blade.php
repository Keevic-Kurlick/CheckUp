@php
    /**
     * @var \App\Models\Order $order
     * @var array $nextSteps
     * @var \App\Models\User $currentUser
     */

    $statusComplete = \App\Models\Order::COMPLETE_STATUS;
    $statusCancel   =\App\Models\Order::CANCEL_STATUS;
@endphp

@extends('layouts.app')

@section('css')
    @parent
@endsection

@section('js')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 button-back-block mt-2">
                <a href="{{ route('orders.index') }}"
                   class="btn btn-outline-success">
                    Назад
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 @if(!empty($nextSteps)) col-lg-6 @endif mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-title d-flex justify-content-between">
                            <div class="col-3">
                                №{{ $order->id }}
                            </div>
                            <div class="col-3">
                                {{ \App\Models\Order::STATUS_MAP[$order->status] }}
                            </div>
                        </div>
                        <div class="card-body">
                            <p> Услуга: {{ $order->service->name }}</p>
                            <p> Врач: {{ $order->doctor?->name ?? 'Не назначен' }}</p>
                        </div>
                    </div>
                </div>

                @if(!empty($nextSteps) && $currentUser->id === $order->doctor?->id)
                    <div class="col-12 mt-2" id="patient_information">
                        <div class="card">
                            <div class="card-header card-title">
                                Информация о пациенте
                            </div>
                            <div class="card-body">
                                <div class="patient_info">
                                    <ul>
                                        <li>ФИО: {{ $order->patient->name }}</li>
                                        <li>
                                            Паспорт: Серия: {{ $order->orderInfo->passport_series }} Номер: {{ $order->orderInfo->passport_number }}
                                        </li>
                                        <li>ИНН: {{ $order->orderInfo->inn }}</li>
                                        <li>СНИЛС: {{ $order->orderInfo->snils }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="patient_files">
                                    <a class="btn btn-info" href="{{ route('orders.downloadPassportScan', $order->id) }}">
                                        Скачать скан паспорта
                                    </a>

                                    <a class="btn btn-info" href="{{ route('orders.downloadAnalysisScan', $order->id) }}">
                                        Скачать скан анализов
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-12 @if(!empty($nextSteps)) col-lg-6 @endif mt-2">
                @if(
                    !empty($nextSteps)
                    && (in_array(\App\Models\Order::IN_PROGRESS_STATUS, $nextSteps)
                    ||  $currentUser->id == $order->doctor?->id)
                )
                    <div class="col-12 actions-block">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Действия</div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('orders.next-step', $order->id) }}" method="post">
                                    @csrf
                                    @foreach($nextSteps as $nextStep)
                                        @if(
                                            in_array($nextStep, [
                                                \App\Models\Order::CANCEL_STATUS,
                                                \App\Models\Order::COMPLETE_STATUS,
                                            ]) )
                                            @continue
                                        @endif
                                        <button type="submit"
                                                class="btn btn-{{ \App\Models\Order::MAP_STEPS_BUTTON_COLOR[$nextStep] }} text-light fw-bolder"
                                                value="{{ $nextStep }}"
                                                name="step">
                                            {{ \App\Models\Order::MAP_STEPS_NAMES_ACTION[$nextStep] }}
                                        </button>
                                    @endforeach
                                </form>
                                @if (in_array($statusComplete, $nextSteps))
                                    <form action="{{ route('orders.complete', $order->id) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="approve_message"
                                                   class="form-label">
                                                Комментарий
                                            </label>
                                            <textarea name="approve_message"
                                                      id="approve_message"
                                                      class="form-control"
                                                      cols="30" rows="10">
                                                {{ old('cancel_message') ?? '' }}
                                            </textarea>

                                            <x-show-error field-name="approve_message" />
                                        </div>

                                        <div class="form-group mt-2">
                                            <button type="submit"
                                                    class="btn
                                                 btn-{{ \App\Models\Order::MAP_STEPS_BUTTON_COLOR[$statusComplete] }}
                                                            text-light
                                                            fw-bolder"
                                                    value="{{ $statusComplete }}"
                                                    name="step">
                                                {{ \App\Models\Order::MAP_STEPS_NAMES_ACTION[$statusComplete] }}
                                            </button>
                                        </div>
                                    </form>
                                @endif

                            </div>
                            @if (in_array($statusCancel, $nextSteps))
                                <div class="card-footer">
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cancel_message"
                                                   class="form-label">
                                                Причина отказа
                                            </label>
                                            <textarea name="cancel_message"
                                                      id="cancel_message"
                                                      class="form-control"
                                                      cols="6" rows="10"
                                                      style="height: 186px">
                                                {{ old('cancel_message') ?? '' }}
                                            </textarea>

                                            <x-show-error field-name="cancel_message" />
                                        </div>
                                        <div class="form-group mt-2">
                                            <button
                                                    type="submit"
                                                    class="btn btn-{{ \App\Models\Order::MAP_STEPS_BUTTON_COLOR[$statusCancel] }}"
                                                    name="step"
                                                    value="{{ $statusCancel }}">
                                                {{ \App\Models\Order::MAP_STEPS_NAMES_ACTION[$statusCancel] }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection