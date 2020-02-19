<?php

return [
    'config' => [
        'kafka' => [
            'broker_list' => getenv('API_KAFKA_BROKER_LIST'),
        ],
    ],
];