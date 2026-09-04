<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the helper dashboard.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Helper Categories
        |--------------------------------------------------------------------------
        */

        $helperCategories = [

            'Date Helpers' => [
                'convertYmdToMdy',
                'convertMdyToYmd',
                'humanDate',
                'timeAgo',
                'isToday',
            ],

            'String Helpers' => [
                'truncateText',
                'slugify',
                'capitalizeWords',
                'removeHtmlTags',
                'wordCount',
            ],

            'Number / Currency Helpers' => [
                'formatCurrency',
                'formatNumber',
            ],

            'Array Helpers' => [
                'isEmptyArray',
                'arrayToString',
            ],

            'Validation Helpers' => [
                'isValidEmail',
                'isValidPhone',
                'isValidUrl',
            ],

            'File Helpers' => [
                'formatFileSize',
            ],

            'Security / Utility Helpers' => [
                'maskEmail',
                'maskPhone',
                'generateRandomCode',
                'getInitials',
            ],

            'URL Helpers' => [
                'getDomainName',
            ],

            'Advanced Data / Collection Helpers' => [
                'safeGet',
                'arrayToQueryString',
                'flattenArray',
                'sortArrayByKey',
                'groupArrayByKey',
                'percentage',
                'isJson',
                'jsonToArray',
                'humanBool',
                'nullableValue',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Helper Statistics
        |--------------------------------------------------------------------------
        */

        $totalHelpers = collect($helperCategories)
            ->flatten()
            ->count();

        $categoryCount = count($helperCategories);


        /*
        |--------------------------------------------------------------------------
        | Advanced Data / Collection Examples
        |--------------------------------------------------------------------------
        */

        $users = [

            [
                'name' => 'John',
                'role' => 'Admin',
                'age' => 30,
            ],

            [
                'name' => 'Alice',
                'role' => 'User',
                'age' => 25,
            ],

            [
                'name' => 'David',
                'role' => 'User',
                'age' => 35,
            ],

            [
                'name' => 'Robert',
                'role' => 'Admin',
                'age' => 28,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Nested Data Example
        |--------------------------------------------------------------------------
        */

        $nestedData = [

            'user' => [

                'profile' => [

                    'name' => 'John Doe',

                    'email' => 'john@example.com',
                ],
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Advanced Helper Results
        |--------------------------------------------------------------------------
        */

        $advancedData = [

            /*
            |------------------------------------------------------------------
            | safeGet()
            |------------------------------------------------------------------
            */

            'safeGet' => safeGet(
                $nestedData,
                'user.profile.name',
                'Unknown'
            ),

            'safeGetFallback' => safeGet(
                $nestedData,
                'user.profile.phone',
                'Not Available'
            ),


            /*
            |------------------------------------------------------------------
            | arrayToQueryString()
            |------------------------------------------------------------------
            */

            'arrayToQueryString' => arrayToQueryString([
                'page' => 2,
                'search' => 'Laravel',
                'status' => 'active',
            ]),


            /*
            |------------------------------------------------------------------
            | flattenArray()
            |------------------------------------------------------------------
            */

            'flattenArray' => flattenArray([

                'frontend' => [
                    'HTML',
                    'CSS',
                ],

                'backend' => [
                    'PHP',
                    'Laravel',
                ],
            ]),


            /*
            |------------------------------------------------------------------
            | sortArrayByKey()
            |------------------------------------------------------------------
            */

            'sortedUsers' => sortArrayByKey(
                $users,
                'name'
            ),


            /*
            |------------------------------------------------------------------
            | groupArrayByKey()
            |------------------------------------------------------------------
            */

            'groupedUsers' => groupArrayByKey(
                $users,
                'role'
            ),


            /*
            |------------------------------------------------------------------
            | percentage()
            |------------------------------------------------------------------
            */

            'percentage' => percentage(
                75,
                100
            ) . '%',


            /*
            |------------------------------------------------------------------
            | isJson()
            |------------------------------------------------------------------
            */

            'isJsonYes' => isJson(
                '{"name":"John","age":30}'
            )
                ? 'Valid JSON ✔'
                : 'Invalid JSON ✘',

            'isJsonNo' => isJson(
                'Laravel is awesome'
            )
                ? 'Valid JSON ✔'
                : 'Invalid JSON ✘',


            /*
            |------------------------------------------------------------------
            | jsonToArray()
            |------------------------------------------------------------------
            */

            'jsonToArray' => jsonToArray(
                '{"name":"John","framework":"Laravel"}'
            ),


            /*
            |------------------------------------------------------------------
            | humanBool()
            |------------------------------------------------------------------
            */

            'humanBoolTrue' => humanBool(true),

            'humanBoolFalse' => humanBool(false),


            /*
            |------------------------------------------------------------------
            | nullableValue()
            |------------------------------------------------------------------
            */

            'nullableValue' => nullableValue(
                null,
                'No value available'
            ),
        ];


        /*
        |--------------------------------------------------------------------------
        | Existing Helper Examples
        |--------------------------------------------------------------------------
        */

        $data = [

            /*
            |------------------------------------------------------------------
            | Date Helpers
            |------------------------------------------------------------------
            */

            'convertYmdToMdy' => convertYmdToMdy(
                '2026-09-04'
            ),

            'convertMdyToYmd' => convertMdyToYmd(
                '09-04-2026'
            ),

            'humanDate' => humanDate(
                '2026-09-04'
            ),

            'timeAgo' => timeAgo(
                now()->subHours(3)
            ),

            'isToday_false' => isToday(
                '2020-01-01'
            )
                ? 'Yes ✔'
                : 'No ✘',

            'isToday_true' => isToday(
                now()
            )
                ? 'Yes ✔'
                : 'No ✘',


            /*
            |------------------------------------------------------------------
            | String Helpers
            |------------------------------------------------------------------
            */

            'truncateText' => truncateText(
                'Laravel custom helper functions make development easier and cleaner.',
                45
            ),

            'slugify' => slugify(
                'Laravel Custom Helper Functions'
            ),

            'capitalizeWords' => capitalizeWords(
                'laravel custom helper functions'
            ),

            'removeHtmlTags' => removeHtmlTags(
                '<p>Hello <strong>Laravel</strong> World</p>'
            ),

            'wordCount' => wordCount(
                'Laravel is an amazing PHP framework'
            ),


            /*
            |------------------------------------------------------------------
            | Number / Currency Helpers
            |------------------------------------------------------------------
            */

            'formatCurrency' => formatCurrency(
                125000
            ),

            'formatNumber' => formatNumber(
                1250000
            ),


            /*
            |------------------------------------------------------------------
            | Array Helpers
            |------------------------------------------------------------------
            */

            'isEmptyArray_yes' => isEmptyArray([])
                ? 'Empty ✔'
                : 'Not Empty',

            'isEmptyArray_no' => isEmptyArray([
                'Laravel',
                'PHP',
                'MySQL',
            ])
                ? 'Empty ✔'
                : 'Not Empty',

            'arrayToString' => arrayToString([
                'Laravel',
                'PHP',
                'MySQL',
            ]),


            /*
            |------------------------------------------------------------------
            | Validation Helpers
            |------------------------------------------------------------------
            */

            'isValidEmail_yes' => isValidEmail(
                'john@example.com'
            )
                ? 'Valid ✔'
                : 'Invalid ✘',

            'isValidEmail_no' => isValidEmail(
                'invalid-email'
            )
                ? 'Valid ✔'
                : 'Invalid ✘',

            'isValidPhone_yes' => isValidPhone(
                '9876543210'
            )
                ? 'Valid ✔'
                : 'Invalid ✘',

            'isValidPhone_no' => isValidPhone(
                '123'
            )
                ? 'Valid ✔'
                : 'Invalid ✘',

            'isValidUrl_yes' => isValidUrl(
                'https://laravel.com'
            )
                ? 'Valid ✔'
                : 'Invalid ✘',

            'isValidUrl_no' => isValidUrl(
                'not-a-valid-url'
            )
                ? 'Valid ✔'
                : 'Invalid ✘',


            /*
            |------------------------------------------------------------------
            | File Helper
            |------------------------------------------------------------------
            */

            'formatFileSize_b' => formatFileSize(
                500
            ),

            'formatFileSize_kb' => formatFileSize(
                5000
            ),

            'formatFileSize_mb' => formatFileSize(
                5000000
            ),

            'formatFileSize_gb' => formatFileSize(
                5000000000
            ),


            /*
            |------------------------------------------------------------------
            | Security / Utility Helpers
            |------------------------------------------------------------------
            */

            'maskEmail' => maskEmail(
                'john.doe@example.com'
            ),

            'maskPhone' => maskPhone(
                '9876543210'
            ),

            'generateRandomCode' => generateRandomCode(
                6
            ),

            'getInitials' => getInitials(
                'John Doe'
            ),


            /*
            |------------------------------------------------------------------
            | URL Helpers
            |------------------------------------------------------------------
            */

            'getDomainName' => getDomainName(
                'https://www.example.com/products'
            ),
        ];


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard View
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard',
            compact(
                'data',
                'helperCategories',
                'totalHelpers',
                'categoryCount',
                'advancedData'
            )
        );
    }


    /**
     * Original helper demo.
     */
    public function callHelper(): JsonResponse
    {
        $date = '2026-09-04';

        return response()->json([
            'original_date' => $date,
            'converted_date' => convertYmdToMdy($date),
        ]);
    }
}

