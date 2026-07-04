<?php

try {
    $autoload = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($autoload)) {
        throw new \Exception("Composer autoloader not found! Expected path: " . $autoload);
    }
    
    $appFile = __DIR__ . '/../bootstrap/app.php';
    if (!file_exists($appFile)) {
        throw new \Exception("Laravel bootstrap app not found! Expected path: " . $appFile);
    }

    $publicIndex = __DIR__ . '/../public/index.php';
    if (!file_exists($publicIndex)) {
        throw new \Exception("Public index not found! Expected path: " . $publicIndex);
    }

    // Forward Vercel requests to Laravel's public/index.php
    require $publicIndex;
} catch (\Throwable $e) {
    header("HTTP/1.1 200 OK");
    echo "<h1>Application Bootstrap Diagnostic</h1>";
    echo "<p><strong>Error Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " on line " . $e->getLine() . "</p>";
    
    echo "<h3>Directory Listing of Project Root:</h3>";
    echo "<pre>";
    $rootDir = realpath(__DIR__ . '/..');
    if ($rootDir && is_dir($rootDir)) {
        $files = scandir($rootDir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $path = $rootDir . '/' . $file;
                echo $file . (is_dir($path) ? '/' : '') . "\n";
            }
        }
    } else {
        echo "Could not read root directory path.";
    }
    echo "</pre>";
    
    echo "<h3>PHP Version:</h3>";
    echo "<pre>PHP Version: " . PHP_VERSION . "\n";
    echo "Loaded extensions: " . implode(', ', get_loaded_extensions()) . "</pre>";
    
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
