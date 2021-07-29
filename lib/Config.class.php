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
 	"APIKEY" => "4736F972-D377-4647-9547-7320B4AL10C0", // Registre aquí su apiKey
 	"SECRETKEY" => "18640589b90e2a482cb50f2ea5acdcbd26d1bfe3", // Registre aquí su secretKey
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
