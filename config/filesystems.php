<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],
        // 設定引用檔案的路徑
        'public' => [
            //表示使用本地檔案系統儲存檔案
            'driver' => 'local', 
            //指定檔案儲存的根目錄
            // storage_path('app/public') 會傳回 storage/app/public 目錄的完整路徑。
            // 這是 Laravel 用來儲存公共檔案的預設位置。
            'root' => storage_path('app/public'),
            //設定包含網路程式位置的路由
            'url' => env('APP_URL').'/storage',
            //指定檔案的可見性， public 表示儲存的檔案是公共的，可以通過 URL 訪問，而不需要身份驗證。
            'visibility' => 'public',
            //檔案操作失敗，不會丟出錯誤
            'throw' => false,
            //檔案操作失敗，不會產生報告
            'report' => false,
        ],

        //設定非專案目錄下的位置
        'external_my' => [
            //表示使用本地檔案系統儲存檔案
            'driver' => 'local',
            // 指定目錄位置
            'root' => 'C:/PIC', 
            //設定包含網路程式位置的路由
            // 'url' => env('APP_URL').'/CCC',  // 在外部目錄的設定沒用          
            
            // //設定包含網路程式位置的路由  //以下也都沒用  對外部目錄  
            // 'url' => env('APP_URL').'/ccc',
            // //指定檔案的可見性， public 表示儲存的檔案是公共的，可以通過 URL 訪問，而不需要身份驗證。
            // 'visibility' => 'public',
            // //檔案操作失敗，不會丟出錯誤
            // 'throw' => false,
            // //檔案操作失敗，不會產生報告
            // 'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
