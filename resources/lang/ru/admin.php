<?php

return [
    'menu' => [
        'users'             => 'Пользователи',
        'users_roles'       => 'Роли',
        'assign_user_role'  => 'Изменить роль',
        'services'          => 'Услуги',
    ],
    'services' => [
        'titles' => [
            'services_create'   => 'Создание услуги',
            'services_edit'     => 'Редактирование услуги',
        ],
        'pages' => [
            'create' => [
                'service_name'          => 'Наименование',
                'service_description'   => 'Описание',
                'service_price'         => 'Цена',
            ]
        ],
    ],
    'notifications' => [
        'role' => [
            'role_was_changed' => [
                'success'   => 'Роль была успешно изменена.',
                'error'     => 'При изменении роли произошла ошибка.',
            ],
        ],
        'service' => [
            'service_was_created' => [
                'success'   => 'Услуга была успешно создана.',
                'error'     => 'При создании услуги произошла ошибка.',
            ],
            'service_was_updated' => [
                'success'   => 'Услуга была успешно обновлена.',
                'error'     => 'При обновлении услуги произошла ошибка.',
            ],
        ],
    ],
];