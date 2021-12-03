<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'bsVersion' => '4.x',
    'mainMenu' => [
        'structure' => [
            'icon' => 'university',
            'label' => 'O\'quv reja',
            'url' => 'curriculum/index',
            'items' => [
                'curriculum/index' => [
                    'label' => 'Ro\'rxati',
                    'url' => 'curriculum/index',
                    'icon' => 'info-circle',
                ],
                'curriculum/week' => [
                    'label' => 'Haftalar',
                    'url' => 'curriculum/week',
                    'icon' => 'info-circle',
                ],

                'curriculum/students-not-join' => [
                    'label' => 'Fanga birkmagan',
                    'url' => 'curriculum/students-not-join',
                    'icon' => 'chart-bar',
                ],


            ],
        ],
        'schedule' => [
            'icon' => 'university',
            'label' => 'Dars jadvali',
            'url' => 'schedule/index',
            'items' => [
                'schedule/statistic' => [
                    'label' => 'Statistika',
                    'url' => 'schedule/statistic',
                    'icon' => 'chart-bar',
                ],

            ],
        ],

        'exams' => [
            'icon' => 'chart-bar',
            'label' => 'Nazoratlar',
            'url' => 'exam/index',
            'items' => [
                'exam/no-student' => [
                    'label' => "Talaba baholanmagan",
                    'url' => 'exam/no-student',
                    'icon' => 'chart-pie',
                ],
                'exam/quality' => [
                    'label' => "Sifat ko'rsatkich",
                    'url' => 'exam/quality',
                    'icon' => 'chart-pie',
                ],
//                'exam/grade2' => [
//                    'label' => "Baholar",
//                    'url' => 'exam/grade2',
//                    'icon' => 'chart-pie',
//                ],
                'exam/performance' => [
                    'label' => "Baholar",
                    'url' => 'exam/performance',
                    'icon' => 'chart-pie',
                ],

//                'performance/index' => [
//                    'label' => 'Baholar',
//                    'url' => 'performance/index',
//                    'icon' => 'chart-bar',
//                ],
            ],
        ],

        'users' => [
            'icon' => 'users',
            'label' => 'Foydalanuvchilar',
            'url' => 'user/index',
            'items' => [
                'user/index' => [
                    'label' => 'Ro\'rxati',
                    'url' => 'user/index',
                    'icon' => 'user-friends',
                ],
                'user/create' => [
                    'label' => 'Yangi foydalanuvchi qo\'shish',
                    'url' => 'user/create',
                    'icon' => 'user-plus',
                ],


            ]
        ],
        'students' => [
            'icon' => 'user-graduate',
            'label' => 'Talabalar',
            'url' => 'student/index',
            'items' => [
                'student/search' => [
                    'label' => 'Qidirish',
                    'url' => 'student/search',
                    'icon' => 'search',
                ],
                'student/login' => [
                    'label' => 'Ro\'rxati',
                    'url' => 'student/logins',
//                    'icon' => 'user-friends',
                ],


            ]
        ],
        'teachers' => [
            'icon' => 'user-graduate',
            'label' => 'O\'qituvchilar',
            'url' => 'teacher/index',
            'items' => [
                'teacher/logins' => [
                    'label' => 'Loginlar',
                    'url' => 'teacher/logins',
                    'icon' => 'search',
                ],
                'student/login' => [
                    'label' => 'Ro\'rxati',
                    'url' => 'student/logins',
//                    'icon' => 'user-friends',
                ],


            ]
        ],


        'backups' => [
            'icon' => 'folder',
            'label' => 'Fayllar',
            'url' => 'backups/index',
            'items' => [
                'user/index' => [
                    'label' => 'Backuplar',
                    'url' => 'backups/index',
                    'icon' => 'file-export',
                ],


            ]
        ],


    ]
];
