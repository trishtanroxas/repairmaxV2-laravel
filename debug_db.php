<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $columns = Schema::getColumnListing('appointments');
    echo "Columns in 'appointments': " . implode(', ', $columns) . PHP_EOL;

    foreach ($columns as $column) {
        $type = Schema::getColumnType('appointments', $column);
        echo "- $column: $type" . PHP_EOL;
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
