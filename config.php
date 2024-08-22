<?php

/**
* Define App Root Directory
*/

define( '__APP_ROOT_DIRECTORY__' ,  __DIR__ );

/**
* Define Telegram API Settings
*/

define( '__TB_TEST_CHAT_ID__', '<insert Test Token if needed>' );
define( '__TB_CHAT_ID__', '<insert chat id>' );
define( '__TB_BOT_TOKEN__', '<insert bot token>' );
define( '__TB_SEND_MESSAGE_ENDPOINT__', 'https://api.telegram.org/bot' . __TB_BOT_TOKEN__ . '/sendMessage' );

/**
 * Define Endpoints
 */

define( '__EXAMPLE_ENDPOINT__', '<define your endpoint here  {check curl.php}>' );
define( '__VALID_TOKEN__', '<define the token here {check cron.php}>' );

/**
* Database Connection Settings
*/

define( '__DB_HOST__', 'localhost:3306' );
define( '__DB_CHARSET__', 'utf8' );
define( '__DB_NAME__', '<insert db name>' );
define( '__DB_USERNAME__', 'insert user' );
define( '__DB_USERPASSWORD__', 'insert password' );

/**
* 
* Database Tables
*
* When creating the column in which you want to save the message, think about which datatype makes sense the most
* to save your message as. If you save it as a varchar consider the length etc. Otherwise you might run into a problem
* where duplicates appear because you crawl messages that are longer than the db entry you are able to save and therefore
* that message will never be caught by the function that checks for duplicates
*/

define( '__TB_LOG_TABLE__', '<insert log table name>' );
define( '__TB_LOG_SENT_MESSAGE_KEY__', '<insert primary key === column name to prevent duplicate entries>' );

/**
 * Keywords that will be used to filter messages
 */

define('__TB_KEYWORDS__', [/* insert strings to check messages for specific keywords if you want to use that */]);

/**
* GLOBAL CACHE is used to save the pdo object inside the cache once the connection is established
*/

$GLOBAL_CACHE = [];

