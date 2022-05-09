@php
    /**
     * @var \App\Models\Order $order
     */
@endphp

@extends ('layouts.app')

@section('content')
    <div class="container order_info">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="col-6 order-service-name">
                            <span>{{ $order->service->name }}</span>
                        </div>
                        <div class="col-6 order-status">
                            Статус: <span> {{ $order->status }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                Доктор: <span>{{ $order->doctor->name ?? 'Не назначен'}}</span>
                            </li>
                            @if (!empty($order->orderResult?->cancel_message))
                                <li>
                                    Причина отмены: <span>{{ $order->orderResult->cancel_message }}</span>
                                </li>
                            @endif
                            @if (!empty($order->orderResult?->approve_message))
                                <li>
                                    Комментарий доктора: <span>{{ $order->orderResult->approve_message }} </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @if($order->status == \App\Models\Order::COMPLETE_STATUS)
                        <div class="card-footer">
                            @if (!empty($order->orderResult->certificate_path))
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
