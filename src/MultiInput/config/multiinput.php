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
        "order" => [
            ["sort" => "ASC"],
            ["title" => "ASC"]
        ],
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
                "type" => "Date",
                "translatable" => true
            ],
//            [
//                "name" => "end_date",
//                "title" => "End date",
//                "type" => "DateTime"
//            ],
            [
                "name" => "advantage_image",
                "title" => "Image",
                "type" => "Image",
                "translatable" => true
            ],
            [
                "name" => "document",
                "title" => "Document pdf",
                "type" => "File",
                "translatable" => true
            ],
            [
                "name" => "sort",
                "title" => "Sort Order",
                "type" => "Number"
            ],
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
                        "title" => "Feature Title",
                        "type" => "Varchar",
                        "translatable" => true
                    ],
                    [
                        "name" => "feature_image",
                        "title" => "Feature Image",
                        "type" => "Image"
                    ],
                ],
                "order" => ["feature_title" => "ASC"],
            ],

        ]
    ],
    //other configNames


];