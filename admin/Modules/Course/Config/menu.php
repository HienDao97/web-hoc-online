<?php

return [
    'Course' => [
        'route'      => 'course.index',
        'permission' => [24,25,26,27],
        'class'      => '',
        'icon'       => 'fa fa-leanpub',
        'name'       => 'users',
        'text'       => 'Quản lý khóa học',
        'order'      => 7,
        'sub'        => [
            [
                'route'      => 'course.index',
                'permission' => [24,25,26,27],
                'class'      => '',
                'icon'       => 'fa fa-user',
                'name'       => 'course',
                'text'       => 'Năm học',
                'order'      => 1,
                'sub'        => []
            ],
            [
                'route'      => 'classroom.index',
                'permission' => [20,21,22,23],
                'class'      => '',
                'icon'       => '',
                'name'       => 'classroom',
                'text'       => 'Khóa học',
                'order'      => 2,
                'sub'        => []
            ],
            [
                'route'      => 'theory.index',
                'permission' => [28,29,30,31],
                'class'      => '',
                'icon'       => 'fa fa-user',
                'name'       => 'theory',
                'text'       => 'Bài học',
                'order'      => 3,
                'sub'        => []
            ],
            [
                'route'      => 'exercise.index',
                'permission' => [32,33,34,35],
                'class'      => '',
                'icon'       => 'fa fa-user',
                'name'       => 'exercise',
                'text'       => 'Bài tập',
                'order'      => 4,
                'sub'        => []
            ],
            [
                'route'      => 'document.index',
                'permission' => [32,33,34,35],
                'class'      => '',
                'icon'       => 'fa fa-user',
                'name'       => 'document',
                'text'       => 'Tài liệu',
                'order'      => 5,
                'sub'        => []
            ]
        ]
    ],
    'dashboard' => [
        'route'      => 'core.dashboard',
        'permission' => [],
        'class'      => '',
        'icon'       => 'fa fa-dashboard',
        'name'       => 'dashboard',
        'text'       => 'core::menu.dashboard',
        'order'      => 1,
        'sub'        => []
    ],
];
