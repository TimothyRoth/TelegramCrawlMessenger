<?php

function curl_endpoints(): array
{

    /**
     * 
     * Use array_merge to combine curls from different endpoints. 
     * If you only have one endpoint, consider returning it without array_merge to prevent the unnecessary function call
     * I left it in to show a possible approach for handling multiple endpoints. 
     * 
     */

    return array_merge(curl_example_endpoint());

}

function curl_example_endpoint(): array
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, __EXAMPLE_ENDPOINT__);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $html = curl_exec($ch);

    curl_close($ch);

    if ($html === false) {
        return [];
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    $messages = [];
    
    /**
     * Check query syntax here:
     * @link https://www.w3.org/TR/xpath-3/
     */

    $query = "//div[contains(@class, 'example-class')]";

    $nodes = $xpath->query($query);

    foreach ($nodes as $node) {

        /**
         * Check methods and attributes available for the $node object here:
         * @link https://www.php.net/manual/en/class.domnode.php
         */

        $message = $node->textContent;

        /**
         * If the message entry can be found inside te log, it will be ignored
         */

        if (is_message_contained_in_logs($message)) {
            continue;
        }

        /**
         * If you want to filter crawled content to contain a specific keyword use this next block and
         * specify the kewyords under __TB_KEYWORDS__ inside the config.php. Otherwise you can delete this passage.
         */

        if (does_string_contain(__TB_KEYWORDS__, $message)) {
            $messages[] = $message;
        }

    }

    return $messages;
}