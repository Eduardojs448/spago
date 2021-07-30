<?php
/**
 * Clase para Configurar el cliente
 * @Filename: Config.class.php
 * @version: 2.0
 * @Author: flow.cl
 * @Email: csepulveda@tuxpan.com
 * @Date: 28-04-2017 11:32
 * @Last Modified by: Carlos Sepulveda
 * @Last Modified time: 28-04-2017 11:32
 */
 
 $COMMERCE_CONFIG = array(
 	"APIKEY" => "72D408EF-5D1A-430E-9C73-8BA96D05LCD", // Registre aquí su apiKey
 	"SECRETKEY" => "3611ecf957ec944249e22d6971f29ff36260e40", // Registre aquí su secretKey
 	//"APIURL" => "https://www.flow.cl/api", // Producción EndPoint
 	"APIURL" => "https://sandbox.flow.cl/api", // Sandbox EndPoint
 	"BASEURL" => "https://solvencia.cl/pagadeudas" //Registre aquí la URL base en su página donde instalará el cliente
 );
 
 class Config {
 	
	static function get($name) {
		global $COMMERCE_CONFIG;
		if(!isset($COMMERCE_CONFIG[$name])) {
			throw new Exception("The configuration element thas not exist", 1);
		}
		return $COMMERCE_CONFIG[$name];
	}
 }
