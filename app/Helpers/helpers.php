<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| DATE HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('convertYmdToMdy')) {
    function convertYmdToMdy($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}

if (! function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (! function_exists('humanDate')) {
    function humanDate($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }
}

if (! function_exists('timeAgo')) {
    function timeAgo($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}

if (! function_exists('isToday')) {
    function isToday($date): bool
    {
        return Carbon::parse($date)->isToday();
    }
}


/*
|--------------------------------------------------------------------------
| STRING HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('truncateText')) {
    function truncateText($text, $limit = 100)
    {
        $text = (string) $text;

        return strlen($text) > $limit
            ? substr($text, 0, $limit) . '...'
            : $text;
    }
}

if (! function_exists('slugify')) {
    function slugify($text)
    {
        $text = preg_replace('/[^A-Za-z0-9\s]/', '', $text);
        $text = preg_replace('/[\s]+/', '-', $text);

        return strtolower(trim($text, '-'));
    }
}

if (! function_exists('capitalizeWords')) {
    function capitalizeWords($text)
    {
        return ucwords(strtolower($text));
    }
}

if (! function_exists('removeHtmlTags')) {
    function removeHtmlTags($text)
    {
        return strip_tags($text);
    }
}

if (! function_exists('wordCount')) {
    function wordCount($text): int
    {
        return str_word_count(strip_tags((string) $text));
    }
}


/*
|--------------------------------------------------------------------------
| NUMBER / CURRENCY HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('formatCurrency')) {
    function formatCurrency($amount, $symbol = '₹')
    {
        return $symbol . number_format($amount, 2);
    }
}

if (! function_exists('formatNumber')) {
    function formatNumber($number)
    {
        return number_format($number);
    }
}


/*
|--------------------------------------------------------------------------
| ARRAY HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('isEmptyArray')) {
    function isEmptyArray($arr): bool
    {
        return empty($arr);
    }
}

if (! function_exists('arrayToString')) {
    function arrayToString($arr, $sep = ', ')
    {
        return implode($sep, $arr);
    }
}


/*
|--------------------------------------------------------------------------
| VALIDATION HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('isValidEmail')) {
    function isValidEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (! function_exists('isValidPhone')) {
    function isValidPhone($phone): bool
    {
        return preg_match('/^[0-9]{10}$/', (string) $phone) === 1;
    }
}

if (! function_exists('isValidUrl')) {
    function isValidUrl($url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}


/*
|--------------------------------------------------------------------------
| FILE HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('formatFileSize')) {
    function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }
}


/*
|--------------------------------------------------------------------------
| SECURITY / UTILITY HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('maskEmail')) {
    function maskEmail($email)
    {
        if (! isValidEmail($email)) {
            return $email;
        }

        [$username, $domain] = explode('@', $email, 2);

        if (strlen($username) <= 1) {
            return '*' . '@' . $domain;
        }

        $visibleCharacters = 1;

        $maskedCharacters = str_repeat(
            '*',
            max(1, strlen($username) - $visibleCharacters)
        );

        return substr($username, 0, $visibleCharacters)
            . $maskedCharacters
            . '@'
            . $domain;
    }
}

if (! function_exists('maskPhone')) {
    function maskPhone($phone)
    {
        $phone = preg_replace('/\D/', '', (string) $phone);

        if (strlen($phone) < 4) {
            return $phone;
        }

        return substr($phone, 0, 2)
            . str_repeat('*', strlen($phone) - 4)
            . substr($phone, -2);
    }
}

if (! function_exists('generateRandomCode')) {
    function generateRandomCode($length = 6)
    {
        $length = max(1, (int) $length);

        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        $charactersLength = strlen($characters);

        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $code;
    }
}

if (! function_exists('getInitials')) {
    function getInitials($name)
    {
        $name = trim(
            preg_replace('/\s+/', ' ', (string) $name)
        );

        if ($name === '') {
            return '';
        }

        $words = explode(' ', $name);

        if (count($words) === 1) {
            return strtoupper(substr($words[0], 0, 2));
        }

        return strtoupper(
            substr($words[0], 0, 1) .
            substr($words[count($words) - 1], 0, 1)
        );
    }
}


/*
|--------------------------------------------------------------------------
| URL HELPERS
|--------------------------------------------------------------------------
*/

if (! function_exists('getDomainName')) {
    function getDomainName($url)
    {
        if (! isValidUrl($url)) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);

        if (! $host) {
            return null;
        }

        return preg_replace('/^www\./i', '', $host);
    }
}


/*
|--------------------------------------------------------------------------
| ADVANCED DATA & COLLECTION HELPERS
|--------------------------------------------------------------------------
*/

/**
 * Safely retrieve a nested value from an array/object.
 *
 * Example:
 * safeGet($user, 'profile.name', 'Unknown')
 */
if (! function_exists('safeGet')) {
    function safeGet($data, $key, $default = null)
    {
        if ($key === null || $key === '') {
            return $data ?? $default;
        }

        $segments = explode('.', $key);

        foreach ($segments as $segment) {

            if (is_array($data) && array_key_exists($segment, $data)) {
                $data = $data[$segment];
                continue;
            }

            if (is_object($data) && isset($data->{$segment})) {
                $data = $data->{$segment};
                continue;
            }

            return $default;
        }

        return $data ?? $default;
    }
}


/**
 * Convert an array into a URL query string.
 *
 * Example:
 * arrayToQueryString(['page' => 2, 'search' => 'Laravel'])
 */
if (! function_exists('arrayToQueryString')) {
    function arrayToQueryString(array $data): string
    {
        return http_build_query($data);
    }
}


/**
 * Flatten a multidimensional array.
 *
 * Example:
 * flattenArray([
 *     'name' => 'John',
 *     'skills' => ['PHP', 'Laravel']
 * ]);
 */
if (! function_exists('flattenArray')) {
    function flattenArray(array $array): array
    {
        $result = [];

        array_walk_recursive(
            $array,
            function ($value) use (&$result) {
                $result[] = $value;
            }
        );

        return $result;
    }
}


/**
 * Sort an array of associative arrays by a specific key.
 *
 * Example:
 * sortArrayByKey($users, 'name')
 */
if (! function_exists('sortArrayByKey')) {
    function sortArrayByKey(
        array $array,
        string $key,
        string $direction = 'asc'
    ): array {
        usort($array, function ($a, $b) use ($key, $direction) {

            $valueA = is_array($a)
                ? ($a[$key] ?? null)
                : null;

            $valueB = is_array($b)
                ? ($b[$key] ?? null)
                : null;

            $comparison = $valueA <=> $valueB;

            return strtolower($direction) === 'desc'
                ? -$comparison
                : $comparison;
        });

        return $array;
    }
}


/**
 * Group an array of associative arrays by a specific key.
 *
 * Example:
 * groupArrayByKey($users, 'role')
 */
if (! function_exists('groupArrayByKey')) {
    function groupArrayByKey(
        array $array,
        string $key
    ): array {
        $result = [];

        foreach ($array as $item) {

            if (! is_array($item)) {
                continue;
            }

            $groupValue = $item[$key] ?? 'unknown';

            $result[$groupValue][] = $item;
        }

        return $result;
    }
}


/**
 * Calculate a percentage safely.
 *
 * Example:
 * percentage(25, 100) => 25%
 */
if (! function_exists('percentage')) {
    function percentage(
        $value,
        $total,
        int $decimals = 2
    ): float {
        if ((float) $total == 0.0) {
            return 0.0;
        }

        return round(
            ((float) $value / (float) $total) * 100,
            $decimals
        );
    }
}


/**
 * Check whether a string contains valid JSON.
 */
if (! function_exists('isJson')) {
    function isJson($value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        json_decode($value);

        return json_last_error() === JSON_ERROR_NONE;
    }
}


/**
 * Safely convert JSON into an array.
 */
if (! function_exists('jsonToArray')) {
    function jsonToArray($json, array $default = []): array
    {
        if (! isJson($json)) {
            return $default;
        }

        $result = json_decode($json, true);

        return is_array($result)
            ? $result
            : $default;
    }
}


/**
 * Convert boolean values into readable Yes/No text.
 */
if (! function_exists('humanBool')) {
    function humanBool($value): string
    {
        return filter_var(
            $value,
            FILTER_VALIDATE_BOOLEAN
        ) ? 'Yes' : 'No';
    }
}


/**
 * Return a fallback value when the supplied value is null/empty.
 */
if (! function_exists('nullableValue')) {
    function nullableValue(
        $value,
        $fallback = 'N/A'
    ) {
        if ($value === null) {
            return $fallback;
        }

        if (is_string($value) && trim($value) === '') {
            return $fallback;
        }

        return $value;
    }
}