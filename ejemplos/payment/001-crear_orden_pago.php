
<?php

/*
echo  $rut = $_POST['rut'];


// echo  $empresa = $_POST['empresa'];
echo $operacion= $_POST['operacion'];

echo  $totMonto = $_POST['monto'];*/




// credenciales
$api_key = '4736F972-D377-4647-9547-7320B4AL10C0';
$secret_key = '18640589b90e2a482cb50f2ea5acdcbd26d1bfe3';
$site = 'sandbox'; // sandbox o production

// incluir autoload composer
require '../../vendor/autoload.php';

// crear cliente
$Client = new \sasco\FlowCL\Client($api_key, $secret_key, $site);

// crear orden de pago
// $Client->createPaymentOrder() modifica $PaymentOrder asignando la respuesta con los datos de la orden
// también lo retorna, pero como lo modifica directamente, no sería necesario ocupar lo retornado
$PaymentOrder = new \sasco\FlowCL\Payment\Order();
$PaymentOrder->setCommerceOrder($operacion);
$PaymentOrder->setSubject('Solvencia Sa');
$PaymentOrder->setCurrency('CLP');
$PaymentOrder->setAmount($totMonto);
$PaymentOrder->setEmail('esolano547@gmail.com');
$PaymentOrder->setPaymentMethod(9);
$PaymentOrder->setUrlConfirmation('https://solvencia.cl/pagadeudas/');
$PaymentOrder->setUrlReturn('https://solvencia.cl/pagadeudas/');
$PaymentOrder->setOptional([
    'rut' => '66666666-6',
    'razon_social' => 'Sin razón social informada',
]);

try {
    $Client->createPaymentOrder($PaymentOrder);
    //echo $PaymentOrder->getUrl()."\n";
    
    header('Location: '.$PaymentOrder->getUrl());

} catch (\Exception $e) {
    die('[error] '.$e->getMessage()."\n");


}

/*
function generaParametrosPago($rut,$totMonto,$idPago){
    $akey = getAkey();
    $params = array(
        'apiKey'            => $akey[0]->value,
        'subject'           => 'Pago deuda',
        'currency'          => 'CLP',
        'amount'            => $totMonto[0]->total,
        'email'             => $email,
        'commerceOrder'     => $idPago,
        'urlConfirmation'   => 'https://solvencia.cl/pagadeudas/',
        'urlReturn'         => 'https://solvencia.cl/pagadeudas/'
    );
    return $params;
}*/