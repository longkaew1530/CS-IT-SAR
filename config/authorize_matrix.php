<?php
return [
    'permissions' => [
        'a',
        'b',
        'c',
        'd',
    ],
    'roles' => [
        'admin' => [],        
        'maker' => [
            'a',
        ],
        'reviewer' => [
            'b',
        ],
        'approver' => [
            'c',
            'd',
        ],
    ],
];