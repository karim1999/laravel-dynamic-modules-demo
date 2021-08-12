<?php

use App\Moduable\Fields\FieldImplementation;
use App\Moduable\Fields\TextFieldImplementation;

return [
    'defaultImplementation' => FieldImplementation::class,
    'implementations' => [
        'text' => TextFieldImplementation::class,
        'select',
        'textarea',
    ],
];
