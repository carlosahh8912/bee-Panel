<?php 

class Api{


    /**
   * Lista registros del API
   *
   * @param string $table
   * @param array $params
   * @param integer $limit
   * @return void
   */
	public static function index($table)
	{	
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "192.168.100.9/aspel/api/v3/".$table,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic dTJhdTA3dUIyQmFmZDM0Nnl0aHBvbG10cnNBYi5BN0F5bC5XZ1J0c2ljbjd5a0tmZ0hXQ2xtS3ZlNXUuOmsyYWswN2tCMkJhZmQzNDZ5dGhwb2xtdHJzQWIuV21pci5UMC9UaC5SYlV6TTlMbHE0MEVLOFFZbTlLVw=="
            ),
        ));

        $response = json_decode(curl_exec($curl),true);
        curl_close($curl);
        return json_output($response['detalle']);
    }

    /**
	* Muestra sólo un registro del API
	* @access public
	* @var string 
	* @return void
	**/
	public static function show($table, $id)
	{	
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => "192.168.100.9/aspel/api/v3/".$table."/".$id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Basic dTJhdTA3dUIyQmFmZDM0Nnl0aHBvbG10cnNBYi5BN0F5bC5XZ1J0c2ljbjd5a0tmZ0hXQ2xtS3ZlNXUuOmsyYWswN2tCMkJhZmQzNDZ5dGhwb2xtdHJzQWIuV21pci5UMC9UaC5SYlV6TTlMbHE0MEVLOFFZbTlLVw=="
                ),
            ));
    
            $response = json_decode(curl_exec($curl), true);
    
            curl_close($curl);
            
            if ($response['status'] == 200) {
                return json_output($response['detalle']);
            }else{
                return 'No se pudo accesar.';
            }
    }

    /**
	* Add a new record to API
	* @access public
	* @var string | array
	* @return bool
	**/
	public static function create($table, $data)
	{	
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "192.168.100.9/aspel/api/v3/".$table,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic dTJhdTA3dUIyQmFmZDM0Nnl0aHBvbG10cnNBYi5BN0F5bC5XZ1J0c2ljbjd5a0tmZ0hXQ2xtS3ZlNXUuOmsyYWswN2tCMkJhZmQzNDZ5dGhwb2xtdHJzQWIuV21pci5UMC9UaC5SYlV6TTlMbHE0MEVLOFFZbTlLVw=="
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, true);
    }
}