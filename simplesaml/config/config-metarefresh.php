<?php

$config = [
    /*
     * Global blacklist: entityIDs that should be excluded from ALL sets.
     */
    #'blacklist' = array(
    #    'http://my.own.uni/idp'
    #),

    /*
     * Conditional GET requests
     * Efficient downloading so polling can be done more frequently.
     * Works for sources that send 'Last-Modified' or 'Etag' headers.
     * Note that the 'data' directory needs to be writable for this to work.
     */
    #'conditionalGET' => true,

    'sets' => [

       
    ],
];

include 'db-config.php';
foreach ($idps_config as $idp_config) {
    $config['sets'][(string)$idp_config['unique_id']] = [
        'cron' => ['hourly'],
        'sources' => [
            [
                'src' => $idp_config['metadata_url'],
            ],
        ],

        'expireAfter' => 34560060, // Maximum 4 days cache time (3600*24*4)
        'outputDir' => 'metadata/'.$idp_config['unique_id'].'/',
        'outputFormat' => 'flatfile',
    ];

}
// var_dump($config);die;
