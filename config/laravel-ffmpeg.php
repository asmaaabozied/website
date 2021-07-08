<?php

return [
    'default_disk' => 'public',

    'ffmpeg' => [
        'binaries' => env('FFMPEG_BINARIES', 'C:\FFmpeg\bin\ffmpeg.exe'),
        //'binaries' => env('FFMPEG_BINARIES', '/usr/bin/ffmpeg'), on server

        'threads' => 12,
    ],

    'ffprobe' => [
        'binaries' => env('FFPROBE_BINARIES', 'C:\FFmpeg\bin\ffprobe.exe'),
        //'binaries' => env('FFPROBE_BINARIES', '/usr/bin/ffprobe'), on server

    ],

    'timeout' => 3600,
];
