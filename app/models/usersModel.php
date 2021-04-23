<?php

/**
 * Plantilla general de modelos
 * Versión 1.0.1
 *
 * Modelo de users
 */
class usersModel extends Model {
  public $t1   = 'usuarios'; // Nombre de la tabla en la base de datos;
  
  // Nombre de tabla 2 que talvez tenga conexión con registros
  //public static $t2 = '__tabla 2___'; 
  //public static $t3 = '__tabla 3___'; 

  function __construct()
  {
    // Constructor general
  }
  
  static function all() {
    // Todos los registros
    // $sql = 'SELECT * FROM tabla ORDER BY id DESC';
    $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, u.estatus , r.id, (r.nombre) AS nombrerol 
					FROM usuarios u
					INNER JOIN roles r
					ON u.idrol = r.id
					WHERE u.estatus != 0 ";
    return ($rows = parent::query($sql)) ? $rows : [];
  }

  static function by_id($id)
  {
    // Un registro con $id
    $sql = 'SELECT u.clave, u.nombre, u.apellido, u.estatus, u.correo, DATE_FORMAT(u.created_at, "%d-%m-%Y") AS registro , r.id, (r.nombre) AS nombrerol, s.ip_address, s.os_user, s.explorer_user, DATE_FORMAT(s.last_login, "%d-%m-%Y") AS ingreso
			FROM usuarios u
			INNER JOIN roles r
			ON u.idrol = r.id
			LEFT JOIN sessiones s
			ON u.id = s.idusuario
			WHERE  u.id = :id AND u.estatus != 0 LIMIT 1';
    return ($rows = parent::query($sql, ['id' => $id])) ? $rows[0] : [];
  }

  public static function list_active($params = [], $limit = null)
	{	

    $table = new usersModel;      
		// It creates the col names and values to bind
		$cols_values = "";
		$limits      = "";
		if (!empty($params)) {
			$cols_values .= "WHERE";
			foreach ($params as $key => $value) {
				$cols_values .= " {$key} != :{$key} AND";
			}
			$cols_values = substr($cols_values, 0 , -3);
		}

		// If $limit is set, set a limit of data read
		if ($limit !== null) {
			$limits = " LIMIT {$limit}";
		}

		// Query creation
		$stmt = "SELECT * FROM $table->t1 {$cols_values}{$limits}";

		// Calling DB and querying
		if (!$rows = parent::query($stmt , $params)) {
      return false;
		}

    return $limit === 1 ? $rows[0] : $rows;
  }
}

