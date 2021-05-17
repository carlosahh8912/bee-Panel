<?php

/**
 * Plantilla general de modelos
 * Versión 1.0.1
 *
 * Modelo de modules
 */
class modulesModel extends Model {
  public static $t1   = '__tabla___'; // Nombre de la tabla en la base de datos;
  
  // Nombre de tabla 2 que talvez tenga conexión con registros
  //public static $t2 = '__tabla 2___'; 
  //public static $t3 = '__tabla 3___'; 

  function __construct()
  {
    // Constructor general
  }
  
  static function all()
  {
    $sql = 'SELECT * FROM modulos WHERE status != "deleted"';
    try {
      return ($rows = parent::query($sql)) ? $rows : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  static function norepeat($name, $id){

    $sql = 'SELECT * FROM modulos WHERE name = :name AND id != :id';
    try {
        return ($rows = parent::query($sql, ['id' => $id, 'name' => $name])) ? $rows[0] : false;
    } catch (Exception $e) {
        throw $e;
    }

  }
}

