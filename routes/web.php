<?php

use Illuminate\Support\Facades\Route;

Route::get('call-helper', function () {
    $mdY = convertYmdToMdy('2022-02-12');
    $ymd = convertMdyToYmd('02-12-2022');
    return "
        <h3>Helper Function Output</h3>
        <p><strong>Converted to MDY:</strong> $mdY</p>
        <p><strong>Converted to YMD:</strong> $ymd</p>
    ";
});

Route::get('dashboard', function () {
    $data = [
        // Date Helpers
        'convertYmdToMdy'  => convertYmdToMdy('2022-02-12'),
        'convertMdyToYmd'  => convertMdyToYmd('02-12-2022'),
        'humanDate'        => humanDate('2022-02-12'),
        'timeAgo'          => timeAgo('2022-02-12'),
        'isToday_false'    => isToday('2022-02-12') ? 'Yes' : 'No',
        'isToday_true'     => isToday(now()->toDateString()) ? 'Yes' : 'No',

        // String Helpers
        'truncateText'     => truncateText('Laravel is an amazing PHP framework for building web applications.', 30),
        'slugify'          => slugify('Hello World Laravel'),
        'capitalizeWords'  => capitalizeWords('hello world laravel'),

        // Number / Currency
        'formatCurrency'   => formatCurrency(1000),
        'formatNumber'     => formatNumber(1000000),

        // Array Helpers
        'isEmptyArray_yes' => isEmptyArray([]) ? 'Yes (Empty)' : 'No (Has Data)',
        'isEmptyArray_no'  => isEmptyArray(['a', 'b']) ? 'Yes (Empty)' : 'No (Has Data)',
        'arrayToString'    => arrayToString(['Laravel', 'PHP', 'MySQL']),

        // Validation
        'isValidEmail_yes' => isValidEmail('test@example.com') ? 'Valid ✔' : 'Invalid ✘',
        'isValidEmail_no'  => isValidEmail('not-an-email') ? 'Valid ✔' : 'Invalid ✘',
        'isValidPhone_yes' => isValidPhone('9876543210') ? 'Valid ✔' : 'Invalid ✘',
        'isValidPhone_no'  => isValidPhone('12345') ? 'Valid ✔' : 'Invalid ✘',

        // File Size
        'formatFileSize_b'  => formatFileSize(512),
        'formatFileSize_kb' => formatFileSize(2048),
        'formatFileSize_mb' => formatFileSize(1048576),
        'formatFileSize_gb' => formatFileSize(1073741824),
    ];

    return view('dashboard', compact('data'));
});
