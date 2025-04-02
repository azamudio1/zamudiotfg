<?php
// config/paypal.php
// Configuración de PayPal para Laravel
return [

'client_id' => env('PAYPAL_CLIENT_ID'),
'client_secret' => env('PAYPAL_CLIENT_SECRET'),
'payment_action' => 'Sale',
'currency' => 'USD',
'settings' => [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // 'sandbox' para pruebas
],
'api_context' => [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // 'sandbox' para pruebas
    'http.ConnectionTimeOut' => 30,
    'log.LogEnabled' => true,
    'log.FileName' => storage_path('logs/paypal.log'),
    'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
],
];
// Configuración de PayPal para Laravel