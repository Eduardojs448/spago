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
 	"APIKEY" => "7FF4FA3F-B4D4-4270-AAA7-1LB632353941",// Registre aquí su apiKey
 	"SECRETKEY" => "d51d63b612d5fd04cf00fbb62d1a3c21f3ed6a34", // Registre aquí su secretKey
 	//"APIURL" => "https://www.flow.cl/api", // Producción EndPoint
 	"APIURL" => "https://sandbox.flow.cl/api", // Sandbox EndPoint
 	"BASEURL" => "https://spago.dev"
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
