@php
    /**
     * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $orders
     */
@endphp

<div class="orders_table overflow-auto">
    <table class="table mt-3 table table-hover">
        <thead class="table-success">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Услуга</th>
                <th scope="col">Доктор</th>
                <th scope="col">Статус</th>
                <th scope="col">Создана</th>
                <th scope="col">Обновлена</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="order-block white-space-nowrap">
                <td>
                    {{ $order->id }}
                </td>
                <td>
                    {{ $order->service_name }}
                </td>
                <td>
                    {{ $order->doctor_name ?? '' }}
                </td>
                <td>
                    {{ \App\Models\Order::STATUS_MAP[$order->status] }}
                </td>
                <td>
                    {{ $order->created_at }}
                </td>
                <td>
                    {{ $order->updated_at }}
                </td>
            </tr>
        @empty
            <tr class="empty-table-data">
                <td colspan="6">Список заказов пуст.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>