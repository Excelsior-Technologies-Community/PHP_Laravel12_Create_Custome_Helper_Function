<?php

use Carbon\Carbon;

// ─── DATE HELPERS ────────────────────────────────────────────────────────────

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
    function isToday($date)
    {
        return Carbon::parse($date)->isToday();
    }
}

// ─── STRING HELPERS ──────────────────────────────────────────────────────────

if (! function_exists('truncateText')) {
    function truncateText($text, $limit = 100)
    {
        return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
    }
}

if (! function_exists('slugify')) {
    function slugify($text)
    {
        return strtolower(trim(preg_replace('/[\s]+/', '-', preg_replace('/[^A-Za-z0-9\s]/', '', $text))));
    }
}

if (! function_exists('capitalizeWords')) {
    function capitalizeWords($text)
    {
        return ucwords(strtolower($text));
    }
}

// ─── NUMBER / CURRENCY HELPERS ───────────────────────────────────────────────

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

// ─── ARRAY HELPERS ───────────────────────────────────────────────────────────

if (! function_exists('isEmptyArray')) {
    function isEmptyArray($arr)
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

// ─── VALIDATION HELPERS ──────────────────────────────────────────────────────

if (! function_exists('isValidEmail')) {
    function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (! function_exists('isValidPhone')) {
    function isValidPhone($phone)
    {
        return preg_match('/^[0-9]{10}$/', $phone);
    }
}

// ─── FILE SIZE HELPER ────────────────────────────────────────────────────────

if (! function_exists('formatFileSize')) {
    function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }
}
