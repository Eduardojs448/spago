<br>
<img width="20%" style="display:block;" src="https://imgur.com/AqkpPQe.jpg">
<br>
<center><h1> Buscador de deudas:</h1> </center>
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
    $id = $_POST['rut'];
    $con = conectar();
    $SQL = 'SELECT * FROM tabladetallepagos WHERE rutDeudor = :rut';
    $stmt = $con->prepare($SQL);
    $result = $stmt->execute(array(':rut'=>$id));
    $rows= $stmt->fetchAll(\PDO::FETCH_OBJ);
}
?>

<div class="container">
  
  <form role="form" method="POST">
    <div class="form-group">
     <strong> <label for="email">RUT:</label></strong>
      <input type="text" class="form-control" name ="rut" placeholder="Ingrese el RUT" required>
      <strong> <label for="email">CORREO:</label></strong>
      <input type="text" class="form-control" name ="email" placeholder="Ingrese el correo" required>
    </div>
  <!-- </div>
    <div class="form-group">
      <label for="email">CORREO:</label>
      <input type="text" class="form-control" name ="email" placeholder="Ingrese el correo" required>
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
  <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>-->
    <button type="submit" class="btn btn-danger">BUSCAR DEUDA</button> 
  </form>
</div>
    <div class="container">
        <div class="panel-heading">
            <div class="panel-body">
            <form action="confirmacion.php" method="POST">            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Rut Deudor</th>
                        <th>Operacion</th>
                        <th>Cuota</th>
                        <th>Fecha Vencimiento</th>
                        <th>Monto</th>
                        <th>Seleccionar</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php if(count($rows)){ ?>
                                    
                                    <?php 
                                      $email=$_POST['email'];
                                      foreach( $rows as $row){ ?> 
                                <input type="hidden" name="email" value="<?php echo $email;?>">
                                <input type="hidden" name="rut" value="<?php echo $row->rutDeudor;?>">
                                <input type="hidden" name="empresa" value="<?php echo $row->empresa;?>">
                                <input type="hidden" name="ordePagoId[]" value="<?php echo $row->idOrdenPago;?>">
                                <input type="hidden" name="cuota[]" value="<?php echo $row->cuota;?>">
                                <input type="hidden" name="monto[]" value="<?php echo $row->monto;?>">
                                <input type="hidden" name="operacion" value="<?php echo $row->operacion;?>">

                            <tr>
                                <td><?php echo $row->idOrdenPago;?></td>
                                <td><?php echo $row->empresa;?></td>
                                <td><?php echo $row->rutDeudor;?></td>
                                <td><?php echo $row->operacion;?></td>
                                <td><?php echo $row->cuota;?></td>
                                <td><?php echo $row->fechaVencimiento;?></td>
							                  <td><?php echo $row->monto;?></td>
                                <input type="hidden" name="check[]" id="<?php echo $row->idOrdenPago;?>" value="0">
								                <td>
                                  <input type="checkbox" 
                                      class="checkcuota" 
                                      ordenId="<?php echo $row->idOrdenPago;?>" 
                                      monto="<?php echo $row->monto;?>"
                                ></td>

                
                            </tr>

                          <?php } ?>

                    <?php } else { ?>
                        <tr>
                            <td colspan="8"> Sin Informacion! ...</td>
                        </tr>
                   <?php } ?>
                </tbody>
            </table>

          
            <button class="btn btn-info " type="submit">PAGAR DEUDA</button>
            </div>
           
            <center><strong><label for="email"> TOTAL DEUDA A PAGAR:</label></strong> </center>
            <center><input type="text" id="sub" value="0" disabled></center>
         
            
        </div>
        
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
        var x, sub=parseInt($('#sub').val()),
            monto=parseInt($(this).attr('monto')),
            ordenId = $(this).attr('ordenId')
            
        if($(this).is(':checked')){
            $(`#${ordenId}`).val(1);

            x = parseInt(sub) + parseInt(monto)

        }else{
            $(`#${ordenId}`).val(0);

            x = parseInt(sub) - parseInt(monto)
        }

        x < 1 ? $('#sub').val(0) : $('#sub').val(x);

    })
  });
</script>




</body>
</html>