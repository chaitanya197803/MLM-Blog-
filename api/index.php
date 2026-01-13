<?php

$coreIndex = __DIR__ . '/../mlm-system-core/public/index.php';

if (!file_exists($coreIndex)) {
    http_response_code(500);
    echo "Error: Application core not found at expected path: " . $coreIndex;
    exit;
}

// Forward Vercel requests to the mlm-system-core/public/index.php
require $coreIndex;
