<?php

return [
    'menu' => [
        'users'                 => 'Пользователи',
        'users_roles'           => 'Роли',
        'assign_user_role'      => 'Изменить роль',
        'services'              => 'Услуги',
        'medical_certificates'  => 'Справки',
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
    'medical_certificates' => [
        'titles' => [
            'create'    => 'Создание справки',
            'edit'      => 'Редактирование справки',
        ],
        'pages' => [
            'create' => [
                'medical_certificate_name'              => 'Наименование',
                'medical_certificate_description'       => 'Описание',
                'medical_certificate_template'          => 'Шаблон справки',
                'medical_certificate_template_label'    => 'Загрузите шаблон справки',
                'medical_certificate_template_params'   => 'Список разрешённых переменных шаблона:'
            ],
            'edit' => [
                'medical_certificate_name'          => 'Наименование',
                'medical_certificate_description'   => 'Описание',
            ]
        ]
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
            'service_was_destroyed' => [
                'success'   => 'Услуга была успешно удалена.',
                'error'     => 'При удалении услуги произошла ошибка.',
            ],
        ],
        'medical_certificate' => [
            'medical_certificate_was_created' => [
                'success'   => 'Справка была успешно создана.',
                'error'     => 'При создании справки произошла ошибка.',
            ],
            'medical_certificate_was_updated' => [
                'success'   => 'Справка была успешно обновлена.',
                'error'     => 'При обновлении справки произошла ошибка.',
            ],
            'medical_certificate_was_destroyed' => [
                'success'   => 'Справка была успешно удалена.',
                'error'     => 'При удалении справки произошла ошибка.',
            ],
            'medical_certificate_not_found' => 'Справка не найдена.',
        ]
    ],
];