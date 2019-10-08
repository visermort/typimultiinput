<?php

define('MULTIINPUT_STATUS_WAITING', 0);
define('MULTIINPUT_STATUS_ACTIVE', 1);
define('MULTIINPUT_STATUS_DISABLE', 2);

$activeLabels = [
    MULTIINPUT_STATUS_WAITING => "Waiting",
    MULTIINPUT_STATUS_ACTIVE => "Active",
    MULTIINPUT_STATUS_DISABLE => "Disable",
];

return [
    //configName
    'advantages' => [
        "single-row" => false,
        "title" => "Advantages",
//        "order" => [
//            ["sort" => "ASC"],
//            "title"
//        ],
        "columns" => [
            [
                "name" => "title",
                "title" => "Title",
                "type" => "Varchar",
                "translatable" => true
            ],
            [
                "name" => "description",
                "title" => "Description",
                "type" => "Text",
                "translatable" => true
            ],
            [
                "name" => "status",
                "title" => "Status",
                "type" => "Dropdown",
                "items" => $activeLabels,
            ],
            [
                "name" => "start_date",
                "title" => "Start date",
                "type" => "Date"
            ],
//            [
//                "name" => "end_date",
//                "title" => "End date",
//                "type" => "DateTime"
//            ],
            [
                "name" => "advantage_image",
                "title" => "Image",
                "type" => "Image"
            ],
            [
                "name" => "document",
                "title" => "Document pdf",
                "type" => "File"
            ],
//            [
//                "name" => "sort",
//                "title" => "Sort Order",
//                "type" => "Number"
//            ],
//            [
//                "name" => "viewed",
//                "title" => "Viewed",
//                "type" => "Boolean",
//                "translatable" => true
//            ],
            [
                "name" => 'features',
                'title'=> 'Features',
                'type' => 'MultiInput',
                'columns' => [
                    [
                        "name" => "feature_title",
                        "title" => "Title",
                        "type" => "Varchar",
                        "translatable" => true
                    ],
                    [
                        "name" => "feature_image",
                        "title" => "Image",
                        "type" => "Image"
                    ],
                ],
                //"order" => "feature_title",
            ],

        ]
    ],
    //other configNames


];