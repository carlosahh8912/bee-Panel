<?php 

/**
 * La primera función de pruebas del curso de creando el framework MVC
 *
 * @return void
 */
function en_custom() {
  return 'ESTOY DENTRO DE CUSTOM_FUNCTIONS.';
}

/**
 * Carga las diferentes divisas soporatadas en el proyecto de pruebas
 *
 * @return void
 */
function get_coins() {
  return 
  [
    'MXN',
    'USD',
    'CAD',
    'EUR',
    'ARS',
    'AUD',
    'JPY'
  ];
}

function unique_multidim_array($array, $key) {
  $temp_array = array();
  $i = 0;
  $key_array = array();

  foreach($array as $val) {
      if (!in_array($val[$key], $key_array)) {
          $key_array[$i] = $val[$key];
          $temp_array[$i] = $val;
      }
      $i++;
  }
  return $temp_array;
}