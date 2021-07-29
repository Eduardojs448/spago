<?php
/**
 * Ejemplo de creación de una orden de cobro, iniciando una transacción de pago
 * Utiliza el método payment/create
 */

$rut = $_POST['rut'];
$empresa = $_POST['empresa'];
$operacion= $_POST['operacion'];
$totMonto = $_POST['monto'];
$email=$_POST['email'];
require_once "./lib/FlowApi.class.php";

//Para datos opcionales campo "optional" prepara un arreglo JSON
$optional = array(
	"rut" => $rut,
	"otroDato" => $operacion



    
);
$optional = json_encode($optional);

//Prepara el arreglo de datos
$params = array(
	"commerceOrder" => rand(1100,2000),
	"subject" => "Pago de prueba",
	"currency" => "CLP",
	"amount" => $totMonto,
	"email" => $email,
	"paymentMethod" => 9,
	"urlConfirmation" => Config::get("BASEURL") . "/examples/payments/confirm.php",
	"urlReturn" => Config::get("BASEURL") ."/examples/payments/result.php",
	"optional" => $optional
);
//Define el metodo a usar
$serviceName = "payment/create";

try {
	// Instancia la clase FlowApi
	$flowApi = new FlowApi;
	// Ejecuta el servicio
	$response = $flowApi->send($serviceName, $params,"POST");
	//Prepara url para redireccionar el browser del pagador
	$redirect = $response["url"] . "?token=" . $response["token"];
	header("location:$redirect");
} catch (Exception $e) {
	echo $e->getCode() . " - " . $e->getMessage();
}

?>