<?php

return [
    'StudentExport' => [
        'route'      => 'student.index',
        'permission' => [36,37,38,39],
        'class'      => '',
        'icon'       => 'fa fa-graduation-cap',
        'name'       => 'student',
        'text'       => 'Quản lý chung',
        'order'      => 7,
        'sub'        => [
            [
                'route'      => 'student.index',
                'permission' => [36,37,38,39],
                'class'      => '',
                'icon'       => '',
                'name'       => 'student',
                'text'       => 'Học sinh',
                'order'      => 7,
                'sub'        => []
            ],
            [
                'route'      => 'slide.index',
                'permission' => [24,25,26,27],
                'class'      => '',
                'icon'       => 'fa fa-user',
                'name'       => 'slide',
                'text'       => 'Slide',
                'order'      => 2,
                'sub'        => []
            ],
            [
                'route'      => 'comment.index',
                'permission' => [24,25,26,27],
                'class'      => '',
                'icon'       => 'fa fa-user',
                'name'       => 'comment',
                'text'       => 'Comment',
                'order'      => 3,
                'sub'        => []
            ],
        ]
    ],
];
