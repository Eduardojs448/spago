<?php
require_once "./lib/FlowApi.class.php";
require_once "./conexion.php";


$con = conectar();

$stmt = $con->prepare("UPDATE ordenes_de_pago_detalle SET estado=:estado, id_transaccion=:id_transaccion WHERE id=:id");

$rut = $_POST['rut'];
$empresa = $_POST['empresa'];
$totMonto = $_POST['monto'];
$email=$_POST['email'];
$detallesId = $_POST['detallesId'];
$ordenPagoId = $_POST['ordenPagoId'];

$optional = array(
	"rut" => $rut,
	"otroDato" => 'test'
);
$optional = json_encode($optional);

//Prepara el arreglo de datos
$params = array(
	"commerceOrder" => $ordenPagoId,
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


    foreach ($detallesId as $detalleId) {
        $con->beginTransaction();
        try{
            $stmt->execute(array(
                'estado' => 'PENDIENTE',
                'id_transaccion' => $response["token"],
                'id' => $detalleId,
            ));
            $con->commit();
        } catch (PDOException $e){
            $con->rollBack();
            echo "Error!: " . $e->getMessage() . "</br>";
        }
	}

	header("location:$redirect");

} catch (Exception $e) {

	echo $e->getCode() . " - " . $e->getMessage();

}