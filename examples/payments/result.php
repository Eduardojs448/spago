<?php
/**
 * Pagina del comercio para redireccion del pagador
 * A esta página Flow redirecciona al pagador pasando vía POST
 * el token de la transacción. En esta página el comercio puede
 * mostrar su propio comprobante de pago
 */
require(__DIR__ . "/../../lib/FlowApi.class.php");

require_once '../../conexion.php';

$con = conectar();
$stmt = $con->prepare("UPDATE ordenes_de_pago_detalle SET estado=:estado WHERE id_transaccion=:id_transaccion");


try {
	//Recibe el token enviado por Flow
	if(!isset($_POST["token"])) {
		throw new Exception("No se recibio el token", 1);
	}
	$token = filter_input(INPUT_POST, 'token');
	$params = array(
		"token" => $token
	);
	//Indica el servicio a utilizar
	$serviceName = "payment/getStatus";
	$flowApi = new FlowApi();
	$response = $flowApi->send($serviceName, $params, "GET");

    $con->beginTransaction();
    try{
        $stmt->execute(array(
            'estado' => 'COMPLETADO',
            'id_transaccion' => $token,
        ));
        $con->commit();
    } catch (PDOException $e){
        $con->rollBack();
        echo "Error!: " . $e->getMessage() . "</br>";
    }
	
	print_r($response);
	
} catch (Exception $e) {
	echo "Error: " . $e->getCode() . " - " . $e->getMessage();
}

?>