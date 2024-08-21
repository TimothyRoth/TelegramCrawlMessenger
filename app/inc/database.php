<?php

 /**
  * 
  * @return array ['success' => bool, 'message' => string, 'pdo' => PDO|Null] 
  *
  */

  function establish_db_connection() : array
  {
      try {
          $dsn = 'mysql:host=' . __DB_HOST__ . ';dbname=' . __DB_NAME__ . ';charset=' . __DB_CHARSET__;
          $pdo = new PDO($dsn, __DB_USERNAME__, __DB_USERPASSWORD__);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return [
              'success' => true,
              'message' => "DB Connection established successfully",
              'pdo' => $pdo
          ];
      } catch(PDOException $e) {
        $message = $e->getMessage();
        error_log($message);
          return [
              'success' => false,
              'message' => $message,
              'pdo' => null
          ];
      }
  }
  
/**
 * 
 * @description
 * checks if the pdo object is already inside the cache and returning it if thats the case
 * else creating a new instance of pdo and saving it inside the array, then return it
 * 
 * @return PDO|bool {returns either the PDO Object or false if the connection could not be established} 
 *
 */

function get_db() : PDO|bool
{

    global $GLOBAL_CACHE;

    if(isset($GLOBAL_CACHE['pdo']))
    {
        return $GLOBAL_CACHE['pdo'];
    }
 
    $db_connection = establish_db_connection();

    if($db_connection['success']) {
        $GLOBAL_CACHE['pdo'] = $db_connection['pdo'];
        return $GLOBAL_CACHE['pdo'];
    }

    return false;
  
}

function add_log_message(string $message): bool
{

    $db = get_db();

    if($db !== false) {
        try {
            $stmt = $db->prepare('INSERT INTO ' . __TB_LOG_TABLE__ . ' (' . __TB_LOG_SENT_MESSAGE_KEY__ . ') VALUES (:message)');
            $stmt->bindParam(':message', $message);
            $stmt->execute();
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
       
    }

    return true;
}

function delete_log_message(string $message): bool
{

    $db = get_db();

    try {
        $stmt = $db->prepare('DELETE FROM ' . __TB_LOG_TABLE__ . ' WHERE ' . __TB_LOG_SENT_MESSAGE_KEY__ . ' = :message');
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        return $stmt->rowCount() > 0;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function read_log_messages(): array|bool
{
    $db = get_db();

    try {
    
        $stmt = $db->prepare('SELECT ' . __TB_LOG_SENT_MESSAGE_KEY__ . ' FROM ' . __TB_LOG_TABLE__);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        return $messages ?: [];

    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

function is_message_contained_in_logs(string $message): bool
{

    $db = get_db();

    try {
     
        $stmt = $db->prepare('SELECT COUNT(*) FROM ' . __TB_LOG_TABLE__ . ' WHERE ' . __TB_LOG_SENT_MESSAGE_KEY__ . ' = :message');
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}