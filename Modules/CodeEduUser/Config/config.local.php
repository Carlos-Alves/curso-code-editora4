<?php

return [
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'controllers_annotations' => [
            __DIR__ .'/../Http/Controllers'
        ]
    ]

];
