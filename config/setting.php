<?php
return [

    //Api_KEY
    'api_key' => env('API_KEY'),


    // Limit Paginate
    'LimitPaginate' => 20,

    // Size For Image
    'image' => [
        'size'  =>   '2048',
        'allow_extensions'  => 'jpeg,png,jpg,gif,svg',
    ],

    // Size For Video
    'video' => [
        'video_size' => '2048',
        'allow_extensions' => 'video/avi,video/mpeg,video/quicktime',
    ]

];
