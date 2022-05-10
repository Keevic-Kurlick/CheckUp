@php
    /**
     * @var \App\Models\Order $order
     */

    $hasApproveMessage  = !empty($order->orderResult?->approve_message);
    $hasCancelMessage   = !empty($order->orderResult?->cancel_message);
    $hasCertificatePath = !empty($order->orderResult?->certificate_path);
@endphp

@extends ('layouts.app')

@section('content')
    <div class="container order_info">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6 order-service-name">
                                        <span>{{ $order->service->name }}</span>
                                    </div>
                                    <div class="col-6 order-status d-flex justify-content-end">
                                        Статус: &nbsp; <span> {{ \App\Models\Order::STATUS_MAP[$order->status] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>
                                        Врач: <span>{{ $order->doctor->name ?? 'Не назначен'}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if($order->status == \App\Models\Order::COMPLETE_STATUS)
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                @if ($hasApproveMessage)
                                    <div class="card-header">
                                        <span>Комментарий врача</span>
                                    </div>
                                    <div class="card-body">
                                        {{ $order->orderResult->approve_message }}
                                    </div>
                                @endif

                                <div class="@if($hasApproveMessage)card-footer @else card-body @endif">
                                    @if($hasCertificatePath)
                                        <form action="{{ route('profile.orders.downloadMedicalCertificate', $order->id) }}">
                                            <button class="btn btn-primary"
                                                    type="submit">
                                                Скачать справку
                                            </button>
                                        </form>
                                    @else
                                        <p>
                                            При получении ссылки на скачивание справки возникла ошибка.
                                            Обратитесь в техническую поддержку.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($order->status == \App\Models\Order::CANCEL_STATUS)
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <span>Причина отказа</span>
                                </div>
                                <div class="card-body">
                                    {{ $order->orderResult->cancel_message }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
