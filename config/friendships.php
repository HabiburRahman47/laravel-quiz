<?php

return [

    'tables' => [
        'fr_pivot' => 'friendships',
        'fr_groups_pivot' => 'user_friendship_groups'
    ],

    'groups' => [
        'acquaintances' => 0,
        'close_friends' => 1,
        'family' => 2
    ]
//    'groups' => [
//        0 => [
//            'slug'=> 'acquaintances',
//            'name'=> 'Acquaintances'
//        ],
//        1 => [
//            'slug'=> 'close_friends',
//            'name'=> 'Close Friends'
//        ],
//        2 => [
//            'slug'=> 'family',
//            'name'=> 'My Super Family'
//        ]
//    ]

];
