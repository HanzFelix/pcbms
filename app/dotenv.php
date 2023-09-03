<?php

$envFile = $_SERVER['DOCUMENT_ROOT'] . '/.env';

if (file_exists($envFile)) {
    $envVariables = parse_ini_file($envFile, false, INI_SCANNER_RAW);
    foreach ($envVariables as $key => $value) {
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}
