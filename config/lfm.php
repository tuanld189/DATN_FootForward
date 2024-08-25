<?php

/*
|--------------------------------------------------------------------------
| Documentation for this config :
|--------------------------------------------------------------------------
| online  => http://unisharp.github.io/laravel-filemanager/config
| offline => vendor/unisharp/laravel-filemanager/docs/config.md
 */
return [

    'use_package_routes' => true,
    'allow_private_folder' => true,
    'private_folder_name' => UniSharp\LaravelFilemanager\Handlers\ConfigHandler::class,
    'allow_shared_folder' => true,
    'shared_folder_name' => 'shares',
    'folder_categories' => [
        'file' => [
            'folder_name' => 'files',
            'startup_view' => 'list',
            'max_size' => 50000,
            'thumb' => true,
            'thumb_width' => 80,
            'thumb_height' => 80,
            'valid_mime' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain'],
        ],
        'image' => [
            'folder_name' => 'photos',
            'startup_view' => 'grid',
            'max_size' => 50000,
            'thumb' => true,
            'thumb_width' => 80,
            'thumb_height' => 80,
            'valid_mime' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
        ],
    ],
    'paginator' => ['perPage' => 30],
    'disk' => 'public',
    'rename_file' => false,
    'rename_duplicates' => false,
    'alphanumeric_filename' => false,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'should_validate_mime' => true,
    'over_write_on_duplicate' => false,
    'disallowed_mimetypes' => ['text/x-php', 'text/html', 'text/plain'],
    'disallowed_extensions' => ['php', 'html'],
    'item_columns' => ['name', 'url', 'time', 'icon', 'is_file', 'is_image', 'thumb_url'],
    'should_create_thumbnails' => true,
    'thumb_folder_name' => 'thumbs',
    'raster_mimetypes' => ['image/jpeg', 'image/pjpeg', 'image/png'],
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => [
        'pdf' => 'Adobe Acrobat',
        'doc' => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls' => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip' => 'Archive',
        'gif' => 'GIF Image',
        'jpg' => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png' => 'PNG Image',
        'ppt' => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
    ],
    'php_ini_overrides' => ['memory_limit' => '256M'],


    'routes' => [
        'prefix' => 'laravel-filemanager',
        'middleware' => ['web', 'auth'],
        'prefix_name' => 'unisharp.lfm.manager',
    ],
];
