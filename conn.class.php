<?php
class conn extends PDO{

  private static $_instance = null;
  public function  __construct() {
    $dsn = 'mysql:dbname=musicverse;host=localhost';
    $user = "root";
    $pwd = "root";
    $attrs = array();
    parent::__construct( $dsn, $user, $pwd, $attrs );
      $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public static function getInstance() {
      if( self::$_instance == null ) {
        self::$_instance = new self();
      }
    return self::$_instance;
    }
}
