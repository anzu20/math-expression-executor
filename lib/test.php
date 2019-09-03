<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require(__DIR__ . '\..\vendor\autoload.php');
//require __DIR__ . '/autoload.php';

use MathExpressionExecutor\RPNExecutor;

$expr = new RPNExecutor();
try {
    echo $expr->calculate('2+2+2');
} catch (Exception $e) {
    echo $e->getMessage();
}