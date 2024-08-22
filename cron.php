<?php

/**
 * Check how to enable a cronjob on your server (ubuntu example):
 * @link https://askubuntu.com/questions/2368/how-do-i-set-up-a-cron-job
 */

require_once __DIR__ . '/config.php';
require_once __APP_ROOT_DIRECTORY__ . '/app/index.php';

/**
 * If you dont want a token to validate the cronjob, feel free to delete or comment this passage out
 */

$token = $_GET['token'] ?? '';

if ($token !== __VALID_TOKEN__) {
    http_response_code(403);
    exit;
}

try {
    push_message(__TB_CHAT_ID__, curl_endpoints());
} catch (JsonException $e) {
    error_log($e->getMessage());
}
