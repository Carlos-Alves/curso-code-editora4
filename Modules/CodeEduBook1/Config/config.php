<?php

return [
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
                'book_manage_all' => 'book-admin/manage_all'
        ]
        ]
];
