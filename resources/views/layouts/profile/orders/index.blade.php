@php
/**
 * @var \App\Models\Order[] $orders
 */
@endphp

@extends ('layouts.app')

@section('content')
    <div class="container">
        <h5> Ваши заказы:</h5>
        <table class="table table-hover order-table">
            <thead>
                <tr>
                    <th scope="col">Услуга</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата оформления</th>
                    <th scope="col">Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('profile.orders.show', $order['id']) }}">
                                {{ $order['service_name'] }}
                            </a>
                        </td>
                        <td>{{ $order['service_price'] }}</td>
                        <td>{{ $order['created_at'] }}</td>
                        <td>{{ $order['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
