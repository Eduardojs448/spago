<?php
require_once './conexion.php';


$con = conectar();

$ruts = [
    ['rut' => 187003210, 'empresa' => 'PRUEBA EMPRESA 1'],
    ['rut' => 187003211, 'empresa' => 'PRUEBA EMPRESA 2'],
    ['rut' => 187003212, 'empresa' => 'PRUEBA EMPRESA 3'],
    ['rut' => 187003213, 'empresa' => 'PRUEBA EMPRESA 4'],
    ['rut' => 187003214, 'empresa' => 'PRUEBA EMPRESA 5'],
];

$stmt = $con->prepare("INSERT INTO 
                                ordenes_de_pago 
                                SET 
                                num_orden=:num_orden, 
                                rut=:rut, 
                                empresa=:empresa, 
                                monto_total=:monto_total, 
                                cuotas=:cuotas, 
                                fecha_orden=NOW()");

$stmt2 = $con->prepare("INSERT INTO 
                                  ordenes_de_pago_detalle 
                                  SET 
                                  fk_orden_pago=:fk_orden_pago, 
                                  num_orden=:num_orden,
                                  rut_deudor=:rut_deudor, 
                                  empresa=:empresa, 
                                  cuota=:cuota, 
                                  cuota_monto=:cuota_monto,
                                  estado=:estado,
                                  fecha_vencimiento=NOW()");

foreach ($ruts as $rut) {

    try {
        $con->beginTransaction();

        $num_orden = rand(25000000,30000000);
        $monto = rand(5000,10000);
        $cuotas = rand(2,6);

        $stmt->execute(array(
            'num_orden' => $num_orden,
            'rut' => $rut['rut'],
            'empresa' => $rut['empresa'],
            'monto_total' => $monto,
            'cuotas' => $cuotas
        ));


        $idOrden = $con->lastInsertId();

        $monto_couta = $monto / $cuotas;
        for ($i = 0; $i < $cuotas; $i++){
            $num_cuota = $i+1;
            $stmt2->execute(array(
                'fk_orden_pago' => $idOrden,
                'num_orden' => $num_orden,
                'rut_deudor' => $rut['rut'],
                'empresa' => $rut['empresa'],
                'cuota' => $num_cuota,
                'cuota_monto' => $monto_couta,
                'estado' => 'DEUDA'

            ));
        }

        $con->commit();

    } catch (PDOException $e){
        $con->rollback();

        echo "Error!: " . $e->getMessage() . "</br>";
    }
}
