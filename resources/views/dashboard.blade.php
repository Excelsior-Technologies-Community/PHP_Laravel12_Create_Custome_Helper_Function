<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Helper Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; color: #333; }

        header {
            background: linear-gradient(135deg, #FF2D20, #c0392b);
            color: white;
            padding: 24px 40px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        header h1 { font-size: 24px; font-weight: 700; }
        header span { font-size: 13px; opacity: 0.85; }

        .container { max-width: 1100px; margin: 36px auto; padding: 0 20px; }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #FF2D20;
            margin: 32px 0 12px;
            padding-left: 10px;
            border-left: 4px solid #FF2D20;
        }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; }

        .card {
            background: white;
            border-radius: 10px;
            padding: 18px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border-top: 3px solid #FF2D20;
            transition: transform 0.15s;
        }
        .card:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.1); }

        .card .fn-name {
            font-size: 13px;
            font-weight: 600;
            color: #888;
            margin-bottom: 6px;
            font-family: monospace;
        }
        .card .fn-output {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            word-break: break-all;
        }
        .card .fn-input {
            font-size: 11px;
            color: #aaa;
            margin-top: 6px;
            font-family: monospace;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        .badge-green { background: #e6f9f0; color: #27ae60; }
        .badge-red   { background: #fdecea; color: #e74c3c; }
        .badge-blue  { background: #eaf3ff; color: #2980b9; }
        .badge-gray  { background: #f0f0f0; color: #555; }

        footer {
            text-align: center;
            padding: 30px;
            color: #aaa;
            font-size: 13px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <div>
        <h1>⚡ Laravel Custom Helper Dashboard</h1>
        <span>All helper functions live output — Laravel 12</span>
    </div>
</header>

<div class="container">

    {{-- DATE HELPERS --}}
    <div class="section-title">📅 Date Helpers</div>
    <div class="grid">
        <div class="card">
            <div class="fn-name">convertYmdToMdy()</div>
            <div class="fn-output">{{ $data['convertYmdToMdy'] }}</div>
            <div class="fn-input">Input: '2022-02-12'</div>
        </div>
        <div class="card">
            <div class="fn-name">convertMdyToYmd()</div>
            <div class="fn-output">{{ $data['convertMdyToYmd'] }}</div>
            <div class="fn-input">Input: '02-12-2022'</div>
        </div>
        <div class="card">
            <div class="fn-name">humanDate()</div>
            <div class="fn-output">{{ $data['humanDate'] }}</div>
            <div class="fn-input">Input: '2022-02-12'</div>
        </div>
        <div class="card">
            <div class="fn-name">timeAgo()</div>
            <div class="fn-output">{{ $data['timeAgo'] }}</div>
            <div class="fn-input">Input: '2022-02-12'</div>
        </div>
        <div class="card">
            <div class="fn-name">isToday()</div>
            <div class="fn-output">
                <span class="badge badge-red">{{ $data['isToday_false'] }}</span> &nbsp;
                <span class="badge badge-green">{{ $data['isToday_true'] }}</span>
            </div>
            <div class="fn-input">'2022-02-12' | today's date</div>
        </div>
    </div>

    {{-- STRING HELPERS --}}
    <div class="section-title">🔤 String Helpers</div>
    <div class="grid">
        <div class="card">
            <div class="fn-name">truncateText($text, 30)</div>
            <div class="fn-output" style="font-size:15px;">{{ $data['truncateText'] }}</div>
            <div class="fn-input">Input: 'Laravel is an amazing PHP framework...'</div>
        </div>
        <div class="card">
            <div class="fn-name">slugify()</div>
            <div class="fn-output" style="font-size:16px;">{{ $data['slugify'] }}</div>
            <div class="fn-input">Input: 'Hello World Laravel'</div>
        </div>
        <div class="card">
            <div class="fn-name">capitalizeWords()</div>
            <div class="fn-output" style="font-size:16px;">{{ $data['capitalizeWords'] }}</div>
            <div class="fn-input">Input: 'hello world laravel'</div>
        </div>
    </div>

    {{-- NUMBER / CURRENCY --}}
    <div class="section-title">💰 Number / Currency Helpers</div>
    <div class="grid">
        <div class="card">
            <div class="fn-name">formatCurrency(1000)</div>
            <div class="fn-output">{{ $data['formatCurrency'] }}</div>
            <div class="fn-input">Symbol: ₹, Decimals: 2</div>
        </div>
        <div class="card">
            <div class="fn-name">formatNumber(1000000)</div>
            <div class="fn-output">{{ $data['formatNumber'] }}</div>
            <div class="fn-input">Input: 1000000</div>
        </div>
    </div>

    {{-- ARRAY HELPERS --}}
    <div class="section-title">📦 Array Helpers</div>
    <div class="grid">
        <div class="card">
            <div class="fn-name">isEmptyArray([])</div>
            <div class="fn-output"><span class="badge badge-red">{{ $data['isEmptyArray_yes'] }}</span></div>
            <div class="fn-input">Input: []</div>
        </div>
        <div class="card">
            <div class="fn-name">isEmptyArray(['a','b'])</div>
            <div class="fn-output"><span class="badge badge-green">{{ $data['isEmptyArray_no'] }}</span></div>
            <div class="fn-input">Input: ['a', 'b']</div>
        </div>
        <div class="card">
            <div class="fn-name">arrayToString()</div>
            <div class="fn-output" style="font-size:16px;">{{ $data['arrayToString'] }}</div>
            <div class="fn-input">Input: ['Laravel', 'PHP', 'MySQL']</div>
        </div>
    </div>

    {{-- VALIDATION --}}
    <div class="section-title">✅ Validation Helpers</div>
    <div class="grid">
        <div class="card">
            <div class="fn-name">isValidEmail('test@example.com')</div>
            <div class="fn-output"><span class="badge badge-green">{{ $data['isValidEmail_yes'] }}</span></div>
            <div class="fn-input">Input: 'test@example.com'</div>
        </div>
        <div class="card">
            <div class="fn-name">isValidEmail('not-an-email')</div>
            <div class="fn-output"><span class="badge badge-red">{{ $data['isValidEmail_no'] }}</span></div>
            <div class="fn-input">Input: 'not-an-email'</div>
        </div>
        <div class="card">
            <div class="fn-name">isValidPhone('9876543210')</div>
            <div class="fn-output"><span class="badge badge-green">{{ $data['isValidPhone_yes'] }}</span></div>
            <div class="fn-input">Input: '9876543210' (10 digits)</div>
        </div>
        <div class="card">
            <div class="fn-name">isValidPhone('12345')</div>
            <div class="fn-output"><span class="badge badge-red">{{ $data['isValidPhone_no'] }}</span></div>
            <div class="fn-input">Input: '12345' (5 digits)</div>
        </div>
    </div>

    {{-- FILE SIZE --}}
    <div class="section-title">📁 File Size Helper</div>
    <div class="grid">
        <div class="card">
            <div class="fn-name">formatFileSize(512)</div>
            <div class="fn-output"><span class="badge badge-blue">{{ $data['formatFileSize_b'] }}</span></div>
            <div class="fn-input">Input: 512 bytes</div>
        </div>
        <div class="card">
            <div class="fn-name">formatFileSize(2048)</div>
            <div class="fn-output"><span class="badge badge-blue">{{ $data['formatFileSize_kb'] }}</span></div>
            <div class="fn-input">Input: 2048 bytes</div>
        </div>
        <div class="card">
            <div class="fn-name">formatFileSize(1048576)</div>
            <div class="fn-output"><span class="badge badge-blue">{{ $data['formatFileSize_mb'] }}</span></div>
            <div class="fn-input">Input: 1048576 bytes</div>
        </div>
        <div class="card">
            <div class="fn-name">formatFileSize(1073741824)</div>
            <div class="fn-output"><span class="badge badge-blue">{{ $data['formatFileSize_gb'] }}</span></div>
            <div class="fn-input">Input: 1073741824 bytes</div>
        </div>
    </div>

</div>

<footer>Laravel 12 · Custom Helper Functions · Built with ❤️</footer>

</body>
</html>
