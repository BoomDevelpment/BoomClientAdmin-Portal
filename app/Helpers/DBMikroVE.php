<?php

namespace App\Helpers;

use \PDO;

use App\Lib\Config;

/**
 * 
 */
class DBMikroVE
{

  Private   $_dbUser;
  private   $_dbPassword;
  private   $_dbHost;
  private   $_dbName;
  private   $_connection;

  private static $_instance;

  public function __construct()
  {

    try {
      $this->_dbHost      = '200.8.190.4';
      $this->_dbUser      = '1QPOBJ';
      $this->_dbPassword  = '97SVC6W28U3JU9F';
      $this->_dbName      = 'Mikrowisp6'; 
      $this->_connection  = new \PDO('mysql:host='.$this->_dbHost.'; dbname='.$this->_dbName, $this->_dbUser, $this->_dbPassword);
      $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $this->_connection->exec("SET CHARACTER SET utf8");

    } catch (\Exception $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function close()
  {
    self::$_instance = null;
  }

  public function prepare($sql)
  {
    return $this->_connection->prepare($sql);
  }

  public function lastId()
  {
    return $this->_connection->lastInsertId();
  }

  public static function instance()
  {
    if(!isset(self::$_instance))
    {
      $class = __CLASS__;
      self::$_instance = new $class;
    }

    return self::$_instance;
  }

  public function __clone()
  {
    trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
  }

/////////////////////////////////////////////////////////////////////////////////

  public static function DBQuery($query)
  {
    try {
      $connection = DBMikroVE::instance();
      $sql        =   $query;
      $query      =   $connection->prepare($sql);
      $query->execute();

      $res        =   $query->fetch(PDO::FETCH_ASSOC);

      return ($res) ? $res : false;

    } catch (\Exception $e) {

      return "Error!: " . $e->getMessage();

    }
  }

/////////////////////////////////////////////////////////////////////////////////

  public static function DBQueryAll($query)
  {
    try {
      $connection = DBMikroVE::instance();
      $sql        =   $query;
      $query      =   $connection->prepare($sql);
      $query->execute();

      $res        =   $query->fetchAll(PDO::FETCH_ASSOC);

      return ($res) ? $res : false;

    } catch (\Exception $e) {

      return "Error!: " . $e->getMessage();

    }
  }

/////////////////////////////////////////////////////////////////////////////////

    public static function DataExecute($query)
    {
      try {
          $connection =   DBMikroVE::instance();
          $sql        =   $query;
          $query      =   $connection->prepare($sql);

          return ($query->execute()) ? true : false;

      } catch (\Exception $e) {

          return "Error!: " . $e->getMessage();

      }
    }

/////////////////////////////////////////////////////////////////////////////////

    public static function DataExecuteLastID($query)
    {
      try {
          $connection =   DBMikroVE::instance();
          $sql        =   $query;
          $query      =   $connection->prepare($sql);
          $rest       =   ($query->execute()) ? true : false;
          $id         =   $connection->lastId();
          
          return ($rest == true) ? $id : false;

      } catch (\Exception $e) {

          return "Error!: " . $e->getMessage();

      }
    }


/////////////////////////////////////////////////////////////////////////////////

}