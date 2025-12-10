# PHP_Laravel12_Create_Custome_Helper_Function

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel" />
  <img src="https://img.shields.io/badge/Custom-Helpers-blue?style=for-the-badge" />
  <img src="https://img.shields.io/badge/Global%20Functions-Enabled-success?style=for-the-badge" />
</p>

---

##  Overview  
This tutorial shows how to create **custom global helper functions** in Laravel 12,  
autoload them using Composer, and use them anywhere — controllers, views, routes, APIs, etc.

✔ Reusable global functions  
✔ Date conversion helpers  
✔ Autoload via Composer  
✔ Route test output  
✔ Blade usage examples  

---

##  Features  
- Create `helpers.php` file  
- Globally autoload helper functions  
- Use in routes / controllers / Blade  
- Clean date formatting helpers  
- Tested output included  

---

#  Folder Structure  
```
app/
└── Helpers/
     └── helpers.php

routes/
└── web.php

composer.json
.env
README.md
```

---

#  Step 1 — Install Laravel  
```bash
composer create-project laravel/laravel example-app
```

---

#  Step 2 — Update .env (Database Config)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

---

#  Step 3 — Create Helper File  

Create directory:

```
app/Helpers/helpers.php
```

Paste code:

```php
<?php

use Carbon\Carbon;

/**
 * Convert Y-m-d → m-d-Y
 */
if (! function_exists('convertYmdToMdy')) {
    function convertYmdToMdy($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}

/**
 * Convert m-d-Y → Y-m-d
 */
if (! function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}
```

---

#  Step 4 — Register Helper in composer.json  

```json
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/Helpers/helpers.php"
        ]
    },

```

---

#  Step 5 — Run Composer Autoload  
```bash
composer dump-autoload
```

---

#  Step 6 — Create Test Route  

```php
Route::get('call-helper', function () {

    $mdy = convertYmdToMdy('2022-02-12'); // Output → 02-12-2022
    $ymd = convertMdyToYmd('02-12-2022'); // Output → 2022-02-12

    return "
        <h3>Helper Function Output</h3>
        <p><strong>Converted to MDY:</strong> $mdy</p>
        <p><strong>Converted to YMD:</strong> $ymd</p>
    ";
});
```

---

#  Step 7 — Run Laravel App  

```bash
php artisan serve
```

Visit:

```
http://localhost:8000/call-helper
```

---

#  OUTPUT (Real Example)

✔ **MDY format output:**  
```
02-12-2022
```

✔ **YMD format output:**  
```
2022-02-12
```
<img width="401" height="173" alt="Screenshot 2025-12-10 142319" src="https://github.com/user-attachments/assets/9ce1301d-5722-4dcf-9b52-56ee497cb564" />

---

#  Step 8 — Use Helpers in Blade Views  

```blade
<p>Date MDY: {{ convertYmdToMdy('2022-02-12') }}</p>
<p>Date YMD: {{ convertMdyToYmd('02-12-2022') }}</p>
```

---


---
**
