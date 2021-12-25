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
                <tr>
                    <td>Оформление справки 003-в/у</td>
                    <td>1000</td>
                    <td>23.08.2022</td>
                    <td>В работе</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection