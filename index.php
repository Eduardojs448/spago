<br>
<img width="20%" style="display:block;" src="https://imgur.com/AqkpPQe.jpg">
<br>
<center><h1 style="margin-top: -70px;"> Buscador de deudas:</h1> </center>
<br>
     <center> <label for="validationTooltipUsername" class="form-label"> Por favor ingrese los datos solicitados para buscar sus deudas.</label></center>
   
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
  <title>Pagos Solvencia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 </head>
<body>

<?php
require('conexion.php');
$rows = [];
if(isset($_POST['rut'])){
    $rut = $_POST['rut'];
    $con = conectar();
    $SQL ="SELECT * FROM ordenes_de_pago_detalle WHERE estado = 'DEUDA' AND rut_deudor = :rut";
    $stmt = $con->prepare($SQL);
    $result = $stmt->execute(array('rut'=>$rut));
    $rows= $stmt->fetchAll(\PDO::FETCH_OBJ);
}
?>

<div class="container">

    <div class="panel-heading">
        <div class="panel-body">
            <form role="form" method="POST">

                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <div class="form-group">
                            <label for=""><b>RUT</b></label>
                            <input type="text" class="form-control" placeholder="Ingrese Rut.." name="rut" value="<?php if(isset($rut)){ echo $rut; } ?>">
                        </div>
                    </div>
                    <div class="col-lg-5 col-xs-12">
                        <label for=""><b>CORREO:</b></label>
                        <input type="text" class="form-control" placeholder="Ingrese Correo.." name="email">
                    </div>
                    <div class="col-lg-2 col-xs-12" style="margin-top: 31px;">
                        <button type="submit" class="btn btn-danger btn-block" style="">BUSCAR DEUDA</button>
                    </div>
                </div>

            </form>


            <form action="confirmacion.php" method="POST">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Rut Deudor</th>
                        <th>Email</th>
                        <th>Cuota</th>
                        <th>Fecha Vencimiento</th>
                        <th>Monto</th>
                        <th>Seleccionar</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($rows)){
                        $email = $_POST['email'];
                        ?>

                        <?php  foreach( $rows as $row){ ?>
                            <input type="hidden" name="email" value="<?php echo $email;?>">
                            <input type="hidden" name="rut" value="<?php echo $row->rut_deudor;?>">
                            <input type="hidden" name="empresa" value="<?php echo $row->empresa;?>">
                            <input type="hidden" name="ordenPagoId" value="<?php echo $row->fk_orden_pago;?>">
                            <input type="hidden" name="ordenPagoDetalleId[]" value="<?php echo $row->id;?>">
                            <input type="hidden" name="monto[]" value="<?php echo $row->cuota_monto;?>">

                            <tr>
                                <td><?php echo $row->num_orden;?></td>
                                <td><?php echo $row->empresa;?></td>
                                <td><?php echo $row->rut_deudor;?></td>
                                <td><?php echo $email;?></td>
                                <td><?php echo $row->cuota;?></td>
                                <td><?php echo $row->fecha_vencimiento;?></td>
                                <td><?php echo $row->cuota_monto;?></td>
                                <input type="hidden" name="check[]" id="<?php echo $row->id;?>" value="0">
                                <td>
                                    <input type="checkbox"
                                           class="checkcuota"
                                           ordenId="<?php echo $row->id;?>"
                                           monto="<?php echo $row->cuota_monto;?>"
                                    >
                                </td>

                            </tr>

                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-rigth"></td>
                            <td  class="text-rigth"><b>Total $ CLP</b></td>
                            <td><b></b><span id="totalPagar">0.00</span></td>
                        </tr>

                    <?php } else { ?>
                        <tr class="text-center">
                            <td colspan="8"> <b>Sin Informacion! ...</b></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>


                <button class="btn btn-info float-right" type="submit">PAGAR DEUDA</button>
        </div>

        <!--<center><strong><label for="email"> TOTAL DEUDA A PAGAR:</label></strong> </center>-->
        <center><input type="hidden" id="sub" value="0" disabled></center>


    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>


  ///scrip para sumar y mostrar la deuda en el input y en el panel de confirmacion
  $(document).ready( function(){
    $('.checkcuota').on('click', function(){
        var x, sub=parseFloat($('#sub').val()),
            monto=parseFloat($(this).attr('monto')),
            ordenId = $(this).attr('ordenId')
            
        if($(this).is(':checked')){
            $(`#${ordenId}`).val(1);

            x = parseFloat(sub) + parseFloat(monto)

        }else{
            $(`#${ordenId}`).val(0);
            x = parseFloat(sub) - parseFloat(monto)
        }

        console.log(x)

        if(x < 1 ){
            $('#sub').val(0.00)
            $('#totalPagar').html(0.00)
        }else{
            $('#sub').val(x.toFixed(2))
            $('#totalPagar').html(x.toFixed(2));
        }

    })
  });
</script>




</body>
</html>