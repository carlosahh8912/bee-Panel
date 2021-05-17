<?php 

class rolesModel extends Model
{

    /**
   * Método para cargar un registro de la base de datos usando su id
   *
   * @return void
   */
    public static function one_dif($name, $id)
    {
        $sql = 'SELECT * FROM roles WHERE name = :name AND id != :id';
        try {
            return ($rows = parent::query($sql, ['id' => $id, 'name' => $name])) ? $rows[0] : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function all($table, $params = [], $limit = null)
	{	
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
		$stmt = "SELECT * FROM $table {$cols_values}{$limits}";

		// Calling DB and querying
		if (!$rows = parent::query($stmt , $params)) {
      return false;
		}

    return $limit === 1 ? $rows[0] : $rows;
  }
}