<?php

return [
    'services' => [
        'show' => [
            'not_found' => 'Услуга не найдена.',
        ],
    ],
    'order_services' => [
        'store' => [
            'success'   => 'Заказ успешно оформлен.',
            'error'     => 'При оформлении заказа произошла ошибка.',
        ],
    ],
    'orders' => [
        'show' => [
            'error'     => 'Заказ не был найден.',
        ],
        'nextStep' => [
            'statuses' => [
                \App\Models\Order::IN_PROGRESS_STATUS => [
                    'success'   => 'Заказ успешно взят в работу.',
                    'error'     => 'При взятии заказа в работу возникла ошибка.',
                ],
                \App\Models\Order::CANCEL_STATUS => [
                    'success'   => 'Заказ успешно отклонён.',
                    'error'     => 'При отклонении заказа возникла ошибка.',
                ],
                \App\Models\Order::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE => [
                    'success'   => 'Справка успешно сформирована.',
                    'error'     => 'При формировании справки возникла ошибка.',
                ],
            ],
        ],
        \App\Models\Order::COMPLETE_STATUS => [
            'success'   => 'Заказ успешно завершён.',
            'error'     => 'При завершении заказа возникла ошибка.',
        ],
        'cancel' => [
            'success'   => 'Заказ успешно отменён.',
            'error'     => 'При отказе возникла ошибка.',
        ],
    ],
    'profile' => [
        'orders' => [
            'show' => [
                'not_found' => 'Заказ был не найден.',
            ],
        ],
    ],
];