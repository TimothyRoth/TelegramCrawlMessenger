<?php

/**
 * 
 * @description
 * simple check wether a string can be found inside an array containing multiple strings 
 * in this application its specifically used to check the message for several keywords that are defined 
 * inside config.php
 * 
 * @param array $haystacks // array of strings 
 * @param string $needle // message to check for containing a specific keyword 
 * @return bool // returns true if needle was found
 * 
 */

function does_string_contain(array $haystacks, string $needle): bool
{
    foreach ($haystacks as $haystack) {
        if (stripos($needle, $haystack) !== false) {
            return true;
        }
    }

    return false;
}