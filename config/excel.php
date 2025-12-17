<?php

use Maatwebsite\Excel\Excel;

return [
    'exports' => [
        /*
        |--------------------------------------------------------------------------
        | Chunk size
        |--------------------------------------------------------------------------
        |
        | When using FromQuery, the query is automatically chunked.
        | Here you can specify how big the chunk should be.
        |
        */
        'chunk_size' => 1000,

        /*
        |--------------------------------------------------------------------------
        | Pre-calculate formulas during export
        |--------------------------------------------------------------------------
        */
        'pre_calculate_formulas' => false,

        /*
        |--------------------------------------------------------------------------
        | Enable strict null comparison
        |--------------------------------------------------------------------------
        |
        | When enabling strict null comparison, the null cell value will
        | be cast to an empty string if the cell is not a formula cell.
        |
        */
        'strict_null_comparison' => false,

        /*
        |--------------------------------------------------------------------------
        | CSV Settings
        |--------------------------------------------------------------------------
        |
        | Configure e.g. delimiter, enclosure and line ending for CSV exports.
        |
        */
        'csv' => [
            'delimiter' => ',',
            'enclosure' => '"',
            'line_ending' => PHP_EOL,
            'use_bom' => false,
            'include_separator_line' => false,
            'excel_compatibility' => false,
            'output_encoding' => '',
            'test_auto_detect' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Worksheet properties
        |--------------------------------------------------------------------------
        |
        | Configure e.g. default title, creator, subject,...
        |
        */
        'properties' => [
            'creator' => '',
            'lastModifiedBy' => '',
            'title' => '',
            'description' => '',
            'subject' => '',
            'keywords' => '',
            'category' => '',
            'manager' => '',
            'company' => '',
        ],

        /*
        |--------------------------------------------------------------------------
        | Temporary Path
        |--------------------------------------------------------------------------
        |
        | Path for temporary files. Use /tmp for serverless environments like Vercel.
        |
        */
        'temp_path' => env('EXCEL_TEMP_PATH', sys_get_temp_dir()),
    ],

    'imports' => [
        /*
        |--------------------------------------------------------------------------
        | Read Only
        |--------------------------------------------------------------------------
        |
        | When dealing with imports, you might only be interested in the
        | data that the sheet exists. By default we ignore all styles,
        | however if you want to do some logic based on style data
        | you can enable it by setting read_only to false.
        |
        */
        'read_only' => true,

        /*
        |--------------------------------------------------------------------------
        | Ignore Empty
        |--------------------------------------------------------------------------
        |
        | When dealing with imports, you might be interested to ignore
        | rows that have null values or empty strings. By default rows
        | containing empty strings or empty values are not ignored but can be
        | ignored by enabling this setting.
        |
        */
        'ignore_empty' => false,

        /*
        |--------------------------------------------------------------------------
        | Heading Row
        |--------------------------------------------------------------------------
        |
        | The heading row index that should be used as heading for the import
        | if you need to use a heading row.
        |
        */
        'heading_row' => [
            'formatter' => 'slug',
        ],

        /*
        |--------------------------------------------------------------------------
        | CSV Settings
        |--------------------------------------------------------------------------
        |
        | Configure e.g. delimiter, enclosure and line ending for CSV imports.
        |
        */
        'csv' => [
            'delimiter' => null,
            'enclosure' => '"',
            'escape_character' => '\\',
            'contiguous' => false,
            'input_encoding' => 'UTF-8',
        ],

        /*
        |--------------------------------------------------------------------------
        | Worksheet properties
        |--------------------------------------------------------------------------
        |
        | Configure e.g. default title, creator, subject,...
        |
        */
        'properties' => [
            'creator' => '',
            'lastModifiedBy' => '',
            'title' => '',
            'description' => '',
            'subject' => '',
            'keywords' => '',
            'category' => '',
            'manager' => '',
            'company' => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Extension detector
    |--------------------------------------------------------------------------
    |
    | Configure here which writer/reader type should be used when the package
    | needs to guess the correct type based on the extension alone.
    |
    */
    'extension_detector' => [
        'xlsx' => Excel::XLSX,
        'xlsm' => Excel::XLSX,
        'xltx' => Excel::XLSX,
        'xltm' => Excel::XLSX,
        'xls' => Excel::XLS,
        'xlt' => Excel::XLS,
        'ods' => Excel::ODS,
        'ots' => Excel::ODS,
        'slk' => Excel::SLK,
        'xml' => Excel::XML,
        'gnumeric' => Excel::GNUMERIC,
        'htm' => Excel::HTML,
        'html' => Excel::HTML,
        'csv' => Excel::CSV,
        'tsv' => Excel::TSV,

        'pdf' => Excel::DOMPDF,
    ],

    /*
    |--------------------------------------------------------------------------
    | Value Binder
    |--------------------------------------------------------------------------
    |
    | PhpSpreadsheet offers a way to hook into the process of a value being
    | written to a cell. In there some assumptions are made on how the
    | value should be formatted. If you want to change those defaults,
    | you can implement your own default value binder.
    |
    | Possible value binders:
    |
    | [DefaultValueBinder::class, StringValueBinder::class]
    |
    */
    'value_binder' => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Configure the cache settings for PhpSpreadsheet.
    | For serverless environments like Vercel, use /tmp directory.
    |
    */
    'cache' => [
        'driver' => 'memory',
        'batch' => [
            'memory_limit' => 60000,
        ],
        'illuminate' => [
            'store' => null,
        ],
        'path' => env('EXCEL_CACHE_PATH', sys_get_temp_dir()),
    ],

    /*
    |--------------------------------------------------------------------------
    | Transaction Handler
    |--------------------------------------------------------------------------
    |
    | By default the import is wrapped in a transaction. This is useful
    | for when an import may fail and you want to retry it. With the
    | transactions, the previous import gets rolled-back.
    |
    | You can disable the transaction handler by setting this to null.
    | Or you can choose a custom made transaction handler here.
    |
    | Supported handlers: null, 'db'
    |
    */
    'transactions' => [
        'handler' => 'db',
        'db' => [
            'connection' => null,
        ],
    ],

    'local_path' => storage_path('app'),
];
