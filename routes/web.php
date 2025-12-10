<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('call-helper', function () {

    // Calling custom helper functions
    $mdY = convertYmdToMdy('2022-02-12');
    $ymd = convertMdyToYmd('02-12-2022');

    // Displaying output in clean format
    return "
        <h3>Helper Function Output</h3>
        <p><strong>Converted to MDY:</strong> $mdY</p>
        <p><strong>Converted to YMD:</strong> $ymd</p>
    ";
});
