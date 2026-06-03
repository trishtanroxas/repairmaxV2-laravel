<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Cities Count: " . \App\Models\SupportedCity::count() . "\n";
foreach (\App\Models\SupportedCity::all() as $city) {
    echo "- City: " . $city->name . " (Active: " . ($city->is_active ? 'Yes' : 'No') . ")\n";
}

echo "\nAnnouncements Count: " . \App\Models\Announcement::count() . "\n";
foreach (\App\Models\Announcement::all() as $ann) {
    echo "- Ann ID: " . $ann->id . ", Style: " . $ann->style . ", Active: " . ($ann->is_active ? 'Yes' : 'No') . ", Content: " . $ann->content . "\n";
}
