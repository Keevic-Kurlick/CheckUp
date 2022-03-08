@php
/**
 * @var \App\Models\Service[] $services
 */
@endphp
<div class="service_table">
    <table class="table mt-3 table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование</th>
            <th scope="col">Описание</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
            <tr>
                <td>
                    {{ $service->id }}
                </td>
                <td>
                    {{ $service->name }}
                </td>
                <td>
                    {{ $service->description }}
                </td>
                <td>
                    {{ $service->price }}
                </td>
                <td>
                    <a href="{{ route('admin.services.edit', $service->id) }}">
                        <i class="fas fa-edit icon-edit"></i>
                    </a>

                    <i class="fas fa-trash-alt icon-remove"></i>
                </td>
            </tr>
        @empty
            <tr class="empty-table-data">
                <td colspan="2">Нет данных</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $services->links() }}
</div>