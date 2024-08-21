<?php

/**
 * 
 * @param string $chat_id
 * @param array $messages
 * 
 * @return void
 * 
 * @throws JsonException
 * 
 */

function push_message(string $chat_id, array $messages): void
{

    foreach ($messages as $content) {

        $message = "🚨 Neue Warnmeldung 🚨\n\n";
        $message .= "ℹ️ Weitere Informationen: $content";

        $data = [
            'chat_id' => $chat_id,
            'text' => $message,
        ];

        $ch = curl_init(__TB_SEND_MESSAGE_ENDPOINT__);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        if ($responseData['ok']) {
            add_log_message($content);
        } else {
            error_log($responseData['description']);
        }
    }
}
