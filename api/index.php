<?php

// Debugging Error (Biar ketahuan kalau ada apa-apa)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

// === KHUSUS VERCEL: FIX STORAGE READ-ONLY ===
// Kita pindahkan semua penulisan file ke folder /tmp
$app->useStoragePath('/tmp/storage');

// Buat folder cache manual di /tmp
$folders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs'
];

foreach ($folders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}
// === AKHIR FIX ===

$request = Illuminate\Http\Request::capture();
$response = $app->handle($request);

$response->send();
$app->terminate();