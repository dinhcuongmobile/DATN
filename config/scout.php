<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Search Driver
    |--------------------------------------------------------------------------
    |
    | This configuration option controls which search driver will be used by
    | Scout. You may choose from "algolia" or "database" for local development.
    |
    */

    'driver' => env('SCOUT_DRIVER', 'algolia'),

    /*
    |--------------------------------------------------------------------------
    | Algolia Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Algolia API credentials. If you're using
    | Algolia as your search driver, you'll need to provide your app ID
    | and secret key, which can be found in your Algolia dashboard.
    |
    */

    'algolia' => [
        'id' => env('ALGOLIA_APP_ID'), // Algolia Application ID
        'secret' => env('ALGOLIA_SECRET'), // Algolia Secret API Key
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    |
    | If you're using the "database" search driver, you may configure which
    | table should be used to store the search index for your models.
    |
    */

    'database' => [
        'connection' => env('DB_CONNECTION', 'mysql'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes for Models
    |--------------------------------------------------------------------------
    |
    | Here you may specify the table prefixes for your models that are
    | indexed for the search. You can define the models that should
    | be searchable by adding them in this array.
    |
    */

    'prefix' => env('SCOUT_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Index Syncing
    |--------------------------------------------------------------------------
    |
    | By default, Scout will sync your models with the search engine as they
    | are saved or deleted. If you'd like to disable this automatic syncing,
    | you may set this option to `false`.
    |
    */

    'sync' => true,

    /*
    |--------------------------------------------------------------------------
    | Pagination Settings
    |--------------------------------------------------------------------------
    |
    | You can configure how many results should be returned for each query.
    |
    */

    'pagination' => [
        'per_page' => 20, // Số lượng kết quả mỗi trang
    ],

    /*
    |--------------------------------------------------------------------------
    | Algolia Advanced Settings
    |--------------------------------------------------------------------------
    |
    | These settings can be used to configure the advanced options for Algolia.
    | You can enable or disable these features based on your project.
    |
    */

    'algolia_settings' => [
        'searchableAttributes' => ['name', 'description'], // Thuộc tính có thể tìm kiếm
        'customRanking' => ['desc(popularity)', 'asc(name)'], // Sắp xếp kết quả tìm kiếm
    ],
];
