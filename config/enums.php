<?php

return [
    'property' => [
        'visibility' => [
            "name" => [
                0 => 'private',
                1 => 'public',
            ],
            "color" => [
                'private' => "danger",
                'public' => "success"
            ]
        ],
    ],
    'property_type' => [
        'suggested' => [
//            "name" => [
//                false => 'Nope',//no->false
//                1 => 'Yes',//yes->true
//            ],
            "label" => [
                "false" => 'No',
                "true" => 'Yes',
            ],
            "color" => [
                'No' => "danger",
                'Yes' => "success"
            ]
        ]
    ],
    'quiz_sessions'=>[
        'status'=>[
            'label'=>[
                'false'=>'incomplete',
                'true'=>'complete'
            ],
            'color'=>[
                'complete'=>'success',
                'incomplete'=>'danger'
            ]
        ]
    ]
];
