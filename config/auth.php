<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'teacher'),
        'passwords' => 'teachers',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'student' => [
        'driver' => 'session',
        'provider' => 'students',
        ],

        'teacher' => [
            'driver' => 'session',
            'provider' => 'teachers',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        'students' => [
        'driver' => 'eloquent',
        'model' => App\Models\Student::class,
        ],
        
        'teachers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Teacher::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'teachers' => [
            'provider' => 'teachers',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
