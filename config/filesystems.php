<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'images_ftp' => [
            'driver'   => 'ftp',
            'host'     => 'images.niceq8i.tv',
            'username' => 'imagesnice',
            'password' => 'cXf06IaaRH2V',
            'port'     => 21,
            'root'     => ''.'/www' ,

            // Optional FTP Settings...

            // 'passive'  => true,
            // 'ssl'      => true,
            // 'timeout'  => 30,

        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'videolib' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'sounds_ftp' => [
            'driver'   => 'ftp',
            'host'     => 'sounds.niceq8i.tv',
            'username' => 'soundsnice',
            'password' => 'EkaFmEAQI7du',
            'port'     => 21,
            'root'     => ''.'/www' ,

        ],

        'videos_ftp' => [
            'driver'   => 'ftp',
            'host'     => 'video.niceq8i.tv',
            'username' => 'videonice',
            'password' => 'dX3vghLXwMDt',
            'port'     => 21,
            'root'     => ''.'/www' ,

        ],

        'uploads' => [
            'driver' => 'local',
            'root'   => public_path() . '/uploads',
            'url' => env('APP_URL'),
        ],


        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
