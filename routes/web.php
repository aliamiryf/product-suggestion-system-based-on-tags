<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
//    \Illuminate\Support\Facades\App::setLocale('en');
    $data = [
        [
            'key' => 'کارگردان',
            'value' => 'امیرحسین مرزبان'
        ],
        [
            'key' => 'تهیه کننده',
            'value' => 'محمدطه ناطقی'
        ],
        [
            'key' => 'مدیرفیلم‌برداری',
            'value' => 'یونس سبزی'
        ],
        [
            'key' => 'تدوین‌گر',
            'value' => 'محمدحسین منیری'
        ],
        [
            'key' => 'مدیرتولید',
            'value' => 'عماد مختاری'
        ],
        [
            'key' => 'مشاور پروژه',
            'value' => 'علی غفاری'
        ],
        [
            'key' => 'بازیگران',
            'value' => 'فرهاد تیمورزاده - آصف جعفری - سجاد احمدنیا - مانی گنجعلی - حسین ذوالفقاری'
        ],
        [
            'key' => 'طراح چهره پردازی',
            'value' => 'نوید فرحمرزی'
        ],
        [
            'key' => 'صدابردار و صداگذار',
            'value' => 'احسان خزایی'
        ],
        [
            'key' => 'طراح صحنه و لباس',
            'value' => 'مریم مشهدی‌رضا'
        ],
        [
            'key' => 'منشی صحنه',
            'value' => 'زهرا ناجی'
        ]
    ];

});
