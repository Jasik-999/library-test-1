<?php
    require_once('config.php');
    
    try{
        $db = new PDO("mysql:host={$db['host']};dbname={$db['database']};charset=utf8", $db['username'], $db['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch( PDOException $e ) {
        echo "Error: " . $e->getMessage();
    }

    function pdoSet($allowed, &$values, $source = array()) {
        $set = '';
        $values = array();
        if (!$source) $source = &$_POST;
        foreach ($allowed as $field) {
          if (isset($source[$field])) {
            $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
            $values[$field] = $source[$field];
          }
        }
        return substr($set, 0, -2); 
      }