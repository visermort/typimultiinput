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
        "columns" => [
            [
                "name" => "title",
                "title" => "Title",
                "type" => "Varchar"
            ],
            [
                "name" => "description",
                "title" => "Description",
                "type" => "Text"
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
//                "name" => "start_datetime",
//                "title" => "Start time",
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
            [
                "name" => 'features',
                'title'=> 'Features',
                'type' => 'MultiInput',
                'columns' => [
                    [
                        "name" => "feature_title",
                        "title" => "Title",
                        "type" => "Varchar"
                    ],
                    [
                        "name" => "feature_image",
                        "title" => "Image",
                        "type" => "Image"
                    ],
                ]
            ],

        ]
    ],
    //other configNames


];