<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Custom Helper Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        /* ─────────────────────────────────────────────
           HEADER
        ───────────────────────────────────────────── */

        header {
            background: linear-gradient(135deg, #ff2d20, #c0392b);
            color: white;
            padding: 28px 40px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
        }

        header h1 {
            font-size: 26px;
            font-weight: 700;
        }

        header span {
            display: block;
            margin-top: 6px;
            font-size: 13px;
            opacity: 0.88;
        }


        /* ─────────────────────────────────────────────
           CONTAINER
        ───────────────────────────────────────────── */

        .container {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }


        /* ─────────────────────────────────────────────
           STATISTICS
        ───────────────────────────────────────────── */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,
                    minmax(220px, 1fr));

            gap: 18px;

            margin-bottom: 35px;
        }

        .stat-card {
            background: white;

            border-radius: 12px;

            padding: 22px;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, 0.07);

            position: relative;

            overflow: hidden;

            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.10);
        }

        .stat-card::after {
            content: "";

            position: absolute;

            width: 70px;
            height: 70px;

            right: -25px;
            top: -25px;

            border-radius: 50%;

            background: rgba(255, 45, 32, 0.08);
        }

        .stat-title {
            font-size: 13px;

            color: #777;

            font-weight: 600;

            text-transform: uppercase;

            letter-spacing: 0.5px;
        }

        .stat-number {
            margin-top: 8px;

            font-size: 32px;

            font-weight: 800;

            color: #ff2d20;
        }


        /* ─────────────────────────────────────────────
           SECTION TITLE
        ───────────────────────────────────────────── */

        .section-title {
            font-size: 13px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;

            color: #ff2d20;

            margin: 32px 0 14px;

            padding-left: 10px;

            border-left: 4px solid #ff2d20;
        }


        /* ─────────────────────────────────────────────
           GRID
        ───────────────────────────────────────────── */

        .grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fill,
                    minmax(300px, 1fr));

            gap: 16px;
        }


        /* ─────────────────────────────────────────────
           CARD
        ───────────────────────────────────────────── */

        .card {
            background: white;

            border-radius: 10px;

            padding: 18px 20px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.07);

            border-top: 3px solid #ff2d20;

            transition: 0.15s;
        }

        .card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 7px 18px rgba(0, 0, 0, 0.10);
        }

        .fn-name {
            font-size: 13px;

            font-weight: 600;

            color: #888;

            margin-bottom: 7px;

            font-family: monospace;
        }

        .fn-output {
            font-size: 20px;

            font-weight: 700;

            color: #1a1a2e;

            word-break: break-word;
        }

        .fn-input {
            font-size: 11px;

            color: #aaa;

            margin-top: 7px;

            font-family: monospace;
        }


        /* ─────────────────────────────────────────────
           BADGES
        ───────────────────────────────────────────── */

        .badge {
            display: inline-block;

            padding: 4px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 600;
        }

        .badge-green {
            background: #e6f9f0;
            color: #27ae60;
        }

        .badge-red {
            background: #fdecea;
            color: #e74c3c;
        }

        .badge-blue {
            background: #eaf3ff;
            color: #2980b9;
        }

        .badge-purple {
            background: #f2eafe;
            color: #7b2cbf;
        }

        .badge-orange {
            background: #fff3e0;
            color: #e67e22;
        }


        /* ─────────────────────────────────────────────
           FOOTER
        ───────────────────────────────────────────── */

        footer {
            text-align: center;

            padding: 30px;

            color: #aaa;

            font-size: 13px;

            margin-top: 40px;
        }

        /* ─────────────────────────────────────────────
   ADVANCED DATA / COLLECTION HELPERS
───────────────────────────────────────────── */

        .advanced-card {
            position: relative;
        }

        .advanced-card .fn-output {
            font-size: 16px;
        }

        .data-list {
            margin-top: 10px;
            padding-left: 18px;
        }

        .data-list li {
            margin-bottom: 5px;
            font-size: 13px;
        }

        .code-output {
            margin-top: 8px;
            padding: 10px 12px;
            background: #f8f9fa;
            border-radius: 7px;
            border-left: 3px solid #ff2d20;
            font-family: monospace;
            font-size: 12px;
            line-height: 1.6;
            word-break: break-word;
        }

        .json-output {
            margin-top: 8px;
            padding: 12px;
            background: #1e1e1e;
            color: #f5f5f5;
            border-radius: 7px;
            font-family: monospace;
            font-size: 12px;
            line-height: 1.6;
            overflow-x: auto;
        }

        .group-box {
            margin-top: 8px;
        }

        .group-title {
            font-size: 12px;
            font-weight: 700;
            color: #ff2d20;
            margin-bottom: 5px;
        }

        .group-item {
            display: inline-block;
            background: #f2eafe;
            color: #7b2cbf;
            padding: 4px 9px;
            border-radius: 15px;
            font-size: 11px;
            margin: 2px;
        }

        .percentage-bar {
            margin-top: 10px;
            height: 9px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
        }

        .percentage-fill {
            height: 100%;
            width: 75%;
            background: #ff2d20;
            border-radius: 10px;
        }

        .helper-count-badge {
            display: inline-block;
            margin-top: 8px;
            padding: 4px 9px;
            border-radius: 15px;
            background: #eaf3ff;
            color: #2980b9;
            font-size: 11px;
            font-weight: 700;
        }


        /* ─────────────────────────────────────────────
           RESPONSIVE
        ───────────────────────────────────────────── */

        @media (max-width: 600px) {

            header {
                padding: 22px 20px;
            }

            header h1 {
                font-size: 21px;
            }

            .container {
                margin-top: 25px;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>


<body>


    <header>

        <h1>⚡ Laravel Custom Helper Dashboard</h1>

        <span>
            Reusable global helper functions — Laravel 12
        </span>

    </header>


    <div class="container">


        {{-- ═══════════════════════════════════════════════
         HELPER STATISTICS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            📊 Helper Statistics
        </div>

        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-title">
                    Total Helpers
                </div>

                <div class="stat-number">
                    {{ $totalHelpers }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Helper Categories
                </div>

                <div class="stat-number">
                    {{ $categoryCount }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    Date Helpers
                </div>

                <div class="stat-number">
                    {{ count($helperCategories['Date Helpers']) }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-title">
                    String Helpers
                </div>

                <div class="stat-number">
                    {{ count($helperCategories['String Helpers']) }}
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         DATE HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            📅 Date Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    convertYmdToMdy()
                </div>

                <div class="fn-output">
                    {{ $data['convertYmdToMdy'] }}
                </div>

                <div class="fn-input">
                    Input: '2022-02-12'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    convertMdyToYmd()
                </div>

                <div class="fn-output">
                    {{ $data['convertMdyToYmd'] }}
                </div>

                <div class="fn-input">
                    Input: '02-12-2022'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    humanDate()
                </div>

                <div class="fn-output">
                    {{ $data['humanDate'] }}
                </div>

                <div class="fn-input">
                    Input: '2022-02-12'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    timeAgo()
                </div>

                <div class="fn-output">
                    {{ $data['timeAgo'] }}
                </div>

                <div class="fn-input">
                    Input: '2022-02-12'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isToday()
                </div>

                <div class="fn-output">

                    <span class="badge badge-red">
                        {{ $data['isToday_false'] }}
                    </span>

                    &nbsp;

                    <span class="badge badge-green">
                        {{ $data['isToday_true'] }}
                    </span>

                </div>

                <div class="fn-input">
                    '2022-02-12' | Today's date
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         STRING HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            🔤 String Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    truncateText($text, 30)
                </div>

                <div class="fn-output"
                    style="font-size:15px;">

                    {{ $data['truncateText'] }}

                </div>

                <div class="fn-input">
                    Input: Laravel is an amazing PHP framework...
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    slugify()
                </div>

                <div class="fn-output"
                    style="font-size:16px;">

                    {{ $data['slugify'] }}

                </div>

                <div class="fn-input">
                    Input: 'Hello World Laravel'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    capitalizeWords()
                </div>

                <div class="fn-output"
                    style="font-size:16px;">

                    {{ $data['capitalizeWords'] }}

                </div>

                <div class="fn-input">
                    Input: 'hello world laravel'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    removeHtmlTags()
                </div>

                <div class="fn-output"
                    style="font-size:16px;">

                    {{ $data['removeHtmlTags'] }}

                </div>

                <div class="fn-input">
                    Input: '&lt;p&gt;Hello &lt;strong&gt;Laravel&lt;/strong&gt;&lt;/p&gt;'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    wordCount()
                </div>

                <div class="fn-output">

                    {{ $data['wordCount'] }} words

                </div>

                <div class="fn-input">
                    Input: 'Laravel is an amazing PHP framework'
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         NUMBER / CURRENCY
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            💰 Number / Currency Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    formatCurrency(1000)
                </div>

                <div class="fn-output">
                    {{ $data['formatCurrency'] }}
                </div>

                <div class="fn-input">
                    Symbol: ₹, Decimals: 2
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    formatNumber(1000000)
                </div>

                <div class="fn-output">
                    {{ $data['formatNumber'] }}
                </div>

                <div class="fn-input">
                    Input: 1000000
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         ARRAY HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            📦 Array Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    isEmptyArray([])
                </div>

                <div class="fn-output">

                    <span class="badge badge-red">
                        {{ $data['isEmptyArray_yes'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: []
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isEmptyArray(['a','b'])
                </div>

                <div class="fn-output">

                    <span class="badge badge-green">
                        {{ $data['isEmptyArray_no'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: ['a', 'b']
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    arrayToString()
                </div>

                <div class="fn-output"
                    style="font-size:16px;">

                    {{ $data['arrayToString'] }}

                </div>

                <div class="fn-input">
                    Input: ['Laravel', 'PHP', 'MySQL']
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         VALIDATION HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            ✅ Validation Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    isValidEmail()
                </div>

                <div class="fn-output">

                    <span class="badge badge-green">
                        {{ $data['isValidEmail_yes'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 'test@example.com'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isValidEmail()
                </div>

                <div class="fn-output">

                    <span class="badge badge-red">
                        {{ $data['isValidEmail_no'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 'not-an-email'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isValidPhone()
                </div>

                <div class="fn-output">

                    <span class="badge badge-green">
                        {{ $data['isValidPhone_yes'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: '9876543210'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isValidPhone()
                </div>

                <div class="fn-output">

                    <span class="badge badge-red">
                        {{ $data['isValidPhone_no'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: '12345'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isValidUrl()
                </div>

                <div class="fn-output">

                    <span class="badge badge-green">
                        {{ $data['isValidUrl_yes'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 'https://laravel.com'
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    isValidUrl()
                </div>

                <div class="fn-output">

                    <span class="badge badge-red">
                        {{ $data['isValidUrl_no'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 'not-a-valid-url'
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         FILE HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            📁 File Size Helper
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    formatFileSize(512)
                </div>

                <div class="fn-output">

                    <span class="badge badge-blue">
                        {{ $data['formatFileSize_b'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 512 bytes
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    formatFileSize(2048)
                </div>

                <div class="fn-output">

                    <span class="badge badge-blue">
                        {{ $data['formatFileSize_kb'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 2048 bytes
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    formatFileSize(1048576)
                </div>

                <div class="fn-output">

                    <span class="badge badge-blue">
                        {{ $data['formatFileSize_mb'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 1048576 bytes
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    formatFileSize(1073741824)
                </div>

                <div class="fn-output">

                    <span class="badge badge-blue">
                        {{ $data['formatFileSize_gb'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 1073741824 bytes
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         SECURITY / UTILITY HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            🔐 Security / Utility Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    maskEmail()
                </div>

                <div class="fn-output"
                    style="font-size:17px;">

                    <span class="badge badge-purple">
                        {{ $data['maskEmail'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: john.doe@example.com
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    maskPhone()
                </div>

                <div class="fn-output">

                    <span class="badge badge-purple">
                        {{ $data['maskPhone'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: 9876543210
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    generateRandomCode()
                </div>

                <div class="fn-output">

                    <span class="badge badge-orange">
                        {{ $data['generateRandomCode'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Random 6-character code
                </div>

            </div>


            <div class="card">

                <div class="fn-name">
                    getInitials()
                </div>

                <div class="fn-output">

                    <span class="badge badge-blue">
                        {{ $data['getInitials'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: John Doe
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
         URL HELPERS
    ═══════════════════════════════════════════════ --}}

        <div class="section-title">
            🌐 URL Helpers
        </div>

        <div class="grid">

            <div class="card">

                <div class="fn-name">
                    getDomainName()
                </div>

                <div class="fn-output"
                    style="font-size:18px;">

                    {{ $data['getDomainName'] }}

                </div>

                <div class="fn-input">
                    Input: https://www.example.com/products
                </div>

            </div>

        </div>


        {{-- ═══════════════════════════════════════════════
     ADVANCED DATA / COLLECTION HELPERS
══════════════════════════════════════════════ --}}

        <div class="section-title">
            ⚡ Advanced Data / Collection Helpers
        </div>

        <div class="grid">


            {{-- safeGet --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    safeGet()
                </div>

                <div class="fn-output">

                    {{ $advancedData['safeGet'] }}

                </div>

                <div class="fn-input">
                    Input: user.profile.name
                </div>

                <span class="helper-count-badge">
                    Nested Data Access
                </span>

            </div>


            {{-- safeGet Fallback --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    safeGet() — Fallback
                </div>

                <div class="fn-output">

                    <span class="badge badge-orange">
                        {{ $advancedData['safeGetFallback'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Missing key: user.profile.phone
                </div>

                <span class="helper-count-badge">
                    Safe Fallback
                </span>

            </div>


            {{-- arrayToQueryString --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    arrayToQueryString()
                </div>

                <div class="fn-output">

                    <div class="code-output">
                        {{ $advancedData['arrayToQueryString'] }}
                    </div>

                </div>

                <div class="fn-input">
                    Converts an associative array into a URL query string
                </div>

            </div>


            {{-- flattenArray --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    flattenArray()
                </div>

                <div class="fn-output">

                    <div class="code-output">

                        {{ implode(
                    ' → ',
                    $advancedData['flattenArray']
                ) }}

                    </div>

                </div>

                <div class="fn-input">
                    Converts nested arrays into a single-level array
                </div>

            </div>


            {{-- percentage --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    percentage(75, 100)
                </div>

                <div class="fn-output">

                    {{ $advancedData['percentage'] }}

                </div>

                <div class="percentage-bar">

                    <div class="percentage-fill"></div>

                </div>

                <div class="fn-input">
                    Calculates percentage safely
                </div>

            </div>


            {{-- isJson --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    isJson()
                </div>

                <div class="fn-output">

                    <span class="badge badge-green">
                        {{ $advancedData['isJsonYes'] }}
                    </span>

                    <br><br>

                    <span class="badge badge-red">
                        {{ $advancedData['isJsonNo'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Validates whether a string contains JSON
                </div>

            </div>


            {{-- jsonToArray --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    jsonToArray()
                </div>

                <div class="fn-output">

                    <div class="json-output">

                        {!! nl2br(
                        e(
                        json_encode(
                        $advancedData['jsonToArray'],
                        JSON_PRETTY_PRINT
                        )
                        )
                        ) !!}

                    </div>

                </div>

                <div class="fn-input">
                    Converts JSON data into a PHP array
                </div>

            </div>


            {{-- humanBool --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    humanBool()
                </div>

                <div class="fn-output">

                    <span class="badge badge-green">
                        True → {{ $advancedData['humanBoolTrue'] }}
                    </span>

                    <br><br>

                    <span class="badge badge-red">
                        False → {{ $advancedData['humanBoolFalse'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Converts boolean values into readable text
                </div>

            </div>


            {{-- nullableValue --}}

            <div class="card advanced-card">

                <div class="fn-name">
                    nullableValue()
                </div>

                <div class="fn-output">

                    <span class="badge badge-orange">
                        {{ $advancedData['nullableValue'] }}
                    </span>

                </div>

                <div class="fn-input">
                    Input: null
                </div>

                <span class="helper-count-badge">
                    Safe Display Value
                </span>

            </div>


        </div>


        {{-- ═══════════════════════════════════════════════
             SORT ARRAY BY KEY
            ══════════════════════════════════════════════ --}}

        <div class="section-title">
            🔤 sortArrayByKey() — Users Sorted By Name
        </div>

        <div class="grid">

            @foreach ($advancedData['sortedUsers'] as $user)

            <div class="card">

                <div class="fn-name">
                    User
                </div>

                <div class="fn-output">

                    {{ $user['name'] }}

                </div>

                <div class="fn-input">

                    Role:
                    {{ $user['role'] }}

                    <br>

                    Age:
                    {{ $user['age'] }}

                </div>

            </div>

            @endforeach

        </div>


        {{-- ═══════════════════════════════════════════════
     GROUP ARRAY BY KEY
══════════════════════════════════════════════ --}}

        <div class="section-title">
            👥 groupArrayByKey() — Users Grouped By Role
        </div>

        <div class="grid">

            @foreach ($advancedData['groupedUsers'] as $role => $users)

            <div class="card">

                <div class="fn-name">
                    Role Group
                </div>

                <div class="fn-output">

                    {{ ucfirst($role) }}

                </div>

                <div class="group-box">

                    @foreach ($users as $user)

                    <span class="group-item">

                        {{ $user['name'] }}

                    </span>

                    @endforeach

                </div>

                <div class="fn-input">

                    {{ count($users) }}
                    user(s) in this group

                </div>

            </div>

            @endforeach

        </div>
    </div>


    <footer>

        Laravel 12 · Custom Helper Functions ·
        {{ $totalHelpers }} Helpers ·
        {{ $categoryCount }} Categories

    </footer>


</body>

</html>