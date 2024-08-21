<?php

/**
 * check how to enable a cronjob on your server
 * @link https://askubuntu.com/questions/2368/how-do-i-set-up-a-cron-job
 */

require_once __DIR__ . '/config.php';
require_once __APP_ROOT_DIRECTORY__ . '/app/index.php';

$token = $_GET['token'] ?? '';
$valid_token = '<insert token here>';

if ($token !== $valid_token) {
    http_response_code(403);
    exit;
}

try {
    push_message(__TB_CHAT_ID__, curl_endpoints());
} catch (JsonException $e) {
    error_log($e->getMessage());
}