<?php

$totMonto = 0;

$rut = '';
$empresa =  '';
$ordePagoId =  '';
$cuota = '';
$monto = '';
$operacion='';
$email=$_POST['email'];


if(isset($_POST['rut'])){
    $rut = $_POST['rut'];
    $empresa = $_POST['empresa'];
    $ordePagoId = $_POST['ordenPagoId'];
    $ordenPagoDetalleId = $_POST['ordenPagoDetalleId'];
    $monto = $_POST['monto'];

    foreach ($_POST['check'] as $key => $value) {
        if($_POST['check'][$key] == 1){
            $totMonto += $monto[$key];

            $detallesId[] = $ordenPagoDetalleId[$key];
        }
    }
}



?>
<br>
<br>
<br>
<img width="20%" style="display:block;" src="https://imgur.com/AqkpPQe.jpg">
<br>
<center><h1> Informacion de Deuda a Pagar :</h1> </center>
<br>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>


<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
          content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" 
          href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
    </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
    </script>
    <style>
        .panel {
            margin: 5px;
        }
    </style>
</head>


<div class="container">
    <div class="panel-heading">
        <div class="panel-body">
    
        <table class="table table-bordered">
        <thead>
            <tr>
            
                <th>Empresa</th>
                <th>Rut Deudor</th>
                <th>Monto</th>

                </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $empresa;?></td>
                <td><?php echo $rut;?></td>
                <td><?php echo $totMonto;?></td>
            </tr>
        </tbody>      
    

    </table>


    <form action="pagoFlowApi.php" method="post"  >
        <input type="hidden"  value ="<?php echo $empresa;?>" name="empresa">
        <input type="hidden"  value ="<?php echo $rut;?>" name="rut">
        <input type="hidden"  value ="<?php echo $totMonto;?>" name="monto">
        <input type="hidden"  value="<?php echo $ordePagoId;?>" name="ordenPagoId" >
        <?php
            /*IDS DE LOS DETALLES DE LA ORDEN DE PAGO*/
            foreach ($detallesId as $id) {
                echo '<input type= "hidden"  value ="'.$id.'" name="detallesId[]">';
            }
        ?>
        <input type= "hidden"  value ="<?php echo $email;?>"name="email">

        <button type="submit" class="btn btn-danger">PAGAR DEUDA</button>
    </form>

</div>
