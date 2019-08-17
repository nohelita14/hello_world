<?php 
    header('Content-Type: text/html; charset=UTF-8');
    require '../conexion.php';

@session_start(); //@ previene warning contra sesiones automáticas (no recomendado)
if(isset($_SESSION['cr_login'])){ 
     $usernameSesion = $_SESSION['cr_login'];
        //asegurar que no tenga "", <, > o &
        $username = htmlspecialchars($usernameSesion);       

$mysqli->set_charset("utf8");
    $mysqli->query("SET NAMES 'utf8'");
    $mysqli->query("SET CHARACTER SET utf8");   


 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>SISTEMA DE CONTROL || INGEMA</title>
    <link rel="stylesheet" href="../../css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css">
    <link  rel = "icono de acceso directo"  href = "../../img/favicon.ico"  type = "image / x-icon" > 
    <link  rel = "icon"  href = "../../img/favicon.ico"  type = "image / x-icon" >
    <link rel="stylesheet" type="text/css" href="../../css/simple-sidebar.css"> 
    <link href="https://fonts.googleapis.com/css?family=PT+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    
    <script src="../../js/jquery-3.3.1.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
   
 

    <!-- Datatables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/b-flash-1.5.4/r-2.2.2/sl-1.2.6/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/b-flash-1.5.4/r-2.2.2/sl-1.2.6/datatables.min.js"></script>
   <!-- CheckBox -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript">
      
     /*  $(document).ready(function() {
        $('#example').DataTable( {
            "language": {
                
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
            }
        } );
    } );
    */
 
</script>


 </head>
 <body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <img class="img-responsive" src="../../img/logo_p.png">
                <li>
                    <a href="index.php">INICIO</a>
                </li>
                <li>
                    <a href="reg_proy.php">PROYECTOS</a>
                </li>
                <li><a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle font-weight-bold">PRESUPUESTO</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu2">
                        <li>
                            <a href="control.php" class="prod"><i class="fa fa-cubes" aria-hidden="true"></i>  Productos</a>
                        </li>
                        <li>
                            <a href="prov.php" class="prov"><i class="fa fa-users" aria-hidden="true"></i>  Proveedor</a>
                        </li>
                        <li>
                            <a href="oc.php" class="oc"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Ordenes de Compra</a>
                        </li>
                        
                        <li>
                            <a href="vali.php" class="vali"><i class="fa fa-barcode" aria-hidden="true"></i>  Validación de OC</a>
                        </li>
                        <li>
                            <a href="gast.php" class="gast"><i class="fa fa-upload" aria-hidden="true"></i>  Gastos EXCEL</a>
                        </li>
                         <li>
                            <a href="#tmoneda" data-toggle="modal" data-target="#tmoneda" class="tc"><i class="fa fa-barcode" aria-hidden="true"></i>  Tasa de Cambio</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="etapa.php">TAREAS</a>
                </li>
                
                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">REPORTES</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li>
                            <a class="re_1" href="report.php"><i class="fa fa-file-pdf" aria-hidden="true"></i>  Control Hora Hombre</a>
                        </li>
                        <li>
                            <a href="gantt.php" class="re_2"><i class="fa fa-barcode" aria-hidden="true"></i>  Ocupación del Personal</a>
                        </li>
                        <li>
                            <a href="report_rp.php" class="re_2"><i class="fa fa-file-pdf" aria-hidden="true"></i>  Resumén de Proyectos</a>
                        </li>
                        <li>
                            <a href="report_pp.php" class="re_2"><i class="fa fa-file-pdf" aria-hidden="true"></i>  Presupuesto por Proyectos</a>
                        </li>
                        <li>
                            <a href="report_oc.php" class="re_2"><i class="fa fa-file-pdf" aria-hidden="true"></i>  OC Generadas</a>
                        </li>
                        <li>
                            <a href="report_rc.php" class="re_2"><i class="fa fa-file-pdf" aria-hidden="true"></i>  Resumén de Comentarios</a>
                        </li>
                    </ul>
                </li>
                
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
               <!-- menu + cerrar sesion -->
                <div class="row justify-content-between">
                  <div class="col-4">    
                  <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">  <i class="fa fa-bars"></i></a></div>
                  
                  <div class="col-1.5">    
                  <a href="../cerrar.php" class="btn btn-success" id="cerrar" title="Cerrar Sesion">  <i class="fa fa-sign-out-alt"></i></a></div>
                </div>
                 <!-- fin menu + cerrar sesion -->
            </div>
        </div>
        <!-- CUERPO TABLA EDITAR-->
<hr class="hr-dark">              

            <div class="card-header">
            <h4><strong>LISTADO DE ORDENES DE COMPRA</strong></h4>
            </div>

        <div class="card-body table-responsive">
            <form action="vali_oc.php"  id="form_oc" method="POST">
                <!--<input type="button" class="btn btn-warning float-right firma" name="vender" value="Firmar Seleccionados" id="vender">-->

                <a class="btn btn-warning float-right" href="#vmodal" name="vender" id="vender" data-toggle="modal" data-target="#vmodal">Firmar Seleccionados</a>
                
                <table border="0" id="example" class="table table-hover table-bordered" cellspacing="0" width="100%">
                    <thead class="table-success" style="font-size: 14px; font-weight: bold;"> 
                        <tr class="headings">
                            
                            <!--<th>ID</th>         -->
                            
                            <th width="auto">OC</th>
                            <th width="auto">CENCOS</th>
                            <th width="auto">CUENTA</th>
                            <th width="auto">PROVEEDOR</th>
                            <th width="auto">CONTACTO</th>
                            <th width="auto">FONO</th>
                            <th width="auto">PRECIO TOTAL</th>
                            <th width="auto">FECHA OC</th>
                            <th width="auto">TIPO DE MONEDA</th>
                            <th width="auto">STATUS</th>
                            <th width="auto">Ver OC</th>
                            <th><input type="checkbox" id="checkTodo"></th>
                            <th width="auto">PDF OC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    
                        include("../function.php");
                        $mysqli->set_charset("utf8");
                        $mysqli->query("SET NAMES 'utf8'");
                        $mysqli->query("SET CHARACTER SET utf8");   

                        $sql = $mysqli->query("SELECT DISTINCT co.cr_id_oc, co.cr_num_oc, ct.cr_nombre as tm, co.cr_cenco, cc.cr_nombre as cuenta, cp.cr_nombre as prov, co.cr_contacto, co.cr_fono, co.cr_precio_t, co.cr_f_oc, cv.cr_nivel FROM cr_oc_validacion cv INNER JOIN cr_tmoneda ct, cr_cuenta cc, cr_proveedor cp, cr_oc co WHERE co.cr_id_cuenta = cc.cr_id_cuenta AND co.cr_id_prov = cp.cr_id_prov AND co.cr_id_tm = ct.cr_id_tm AND co.cr_num_oc = cv.cr_num_oc ORDER BY co.cr_num_oc ASC");
                        while($row = mysqli_fetch_object($sql))
                        {   $id = $row->cr_id_oc;
                     ?>
                        <tr  style="font-size: 12px;">
                            
                            <td style="text-align: justify;"><?php echo $row->cr_num_oc;?></td>
                            <td style="text-align: center;"><?php echo $row->cr_cenco;?></td>
                            <td style="text-align: justify;"><?php echo $row->cuenta;?></td>
                            <td style="text-align: justify;"><?php echo $row->prov;?></td>
                            <td style="text-align: justify;"><?php echo $row->cr_contacto;?></td>
                            <td style="text-align: center;"><?php echo $row->cr_fono;?></td>
                           
                            <td style="text-align: justify;">$ <?php echo number_format($row->cr_precio_t,2, ',','.');?></td>
                            <td style="text-align: justify;"><?php echo $row->cr_f_oc;?></td>
                            <td style="text-align: justify;"><?php echo $row->tm;?></td>
                            <td style="text-align: justify;" bgcolor="<?php 
                                      if($row->cr_nivel == 1){
                                            echo "#D40000";
                                        }elseif($row->cr_nivel == 2){
                                            echo "#FFB818";    
                                        }elseif($row->cr_nivel == 3){
                                            echo "#1DA83F";
                                        }else{
                                            echo "#00CCFF";
                                        }
                            ?>"><?php if($row->cr_nivel == 1){
                                            echo "GENERADO POR JEFE DE COMPRAS ";
                                        }elseif($row->cr_nivel == 2){
                                            echo "FIRMADO POR GERENTE PROYECTO";    
                                        }elseif($row->cr_nivel == 3){
                                            echo "FIRMADO POR GERENTE GENERAL";
                                        }else{
                                            echo "ANULADO";   
                                        } ?></td>
                       <td style="text-align: center;">
                            
                            <a class="btn btn-success" href="cotizacion_html.php?id=<?php echo $id; ?>"><i class="fa fa-file-text" aria-hidden="true" style="color: #fff;"></i></a>
                       </td>
                                     
                       <td>
                            <?php if($row->cr_nivel <> 4){

                            echo '<input type="checkbox" class="checkbox" name="check" value="'.$row->cr_id_oc.'">';
                        } ?>
                       </td>
                       <td style="text-align: center;">
                            <?php if($row->cr_nivel == 3){
                                echo '<a class="btn " href="cotizacionpdf.php?id='.$id.'"><i class="fa fa-file-pdf-o" aria-hidden="true" style="background-color:transparent; color:red;"></i></a>';
                            } ?>
                        
                       </td>
                        </tr>
                           <?php } ?>
                    </tbody>
                </table>
                
            </form>        
        </div>



        <!-- FIN DE CUERPO -->
        <!-- ---------------------------------------------------REG. clave------------------------------------------------------------------------------>    
    <div class="modal fade" id="vmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="vali_oc.php" method="post" id="formh">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>CONFIRMAR FIRMA</strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                        <div class="modal-body">
                            <div class="form-row">
                                
                                <div class="form-group col-md-6"><span id="oc" name="oc"></span>
                                    <input type="hidden" name="user" value="<?php echo $username; ?>">
                                    <input type="password" class="form-control mb-2 mr-sm-2" name="vl" id="vl" placeholder="Clave de Sesión">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="submit" name="submit" class="btn btn-success" id="send" value="VALIDAR">
                                </div>
                            </div>
                            
                                
                            
                        </div>
                </form>
            </div>       
        </div>
    </div>

<!-- FIN DE MODAL REG. TIPO PROYECTO ------------------------------------------------------------------------------------------->
 <!-- ---------------------------------------------------REG. TIPO MONEDA------------------------------------------------------------------------------>    
            <div class="modal fade" tabindex="-1" role="dialog" id="tmoneda" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="guardar_tm.php" method="post" id="formtm">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>TIPO DE MONEDA</strong></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    
                                    <div class="form-group col-md-6">
                                        <label class="#" for="tm">NOMBRE</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" name="tm" id="tm" class="form-control" placeholder="Ingrese Moneda">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="#" for="tm">ABREVIATURA</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" name="ab" id="ab" class="form-control" placeholder="USD - CLP - UF ">
                                        
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-success" id="send1" value="REGISTRAR">
                                </div>
                            </div>
                        </form>
                        <hr class="hr-dark">
                        <!-- INICIO TABLA -->
                        <div class="card-body table-responsive">
                                <table border="0" id="example3" class="table table-hover table-sm" cellspacing="0" width="100%">
                                    <thead class="table-success" style="font-size: 12px; font-weight: bold; text-align: center;"> 
                                        <tr>
                                            <th width="5">NOMBRE</th>
                                            <th width="5">ABREVIATURA</th>
                                            
                                            <th width="1">ELIMINAR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    
                                        $mysqli->set_charset("utf8");
                                        $mysqli->query("SET NAMES 'utf8'");
                                        $mysqli->query("SET CHARACTER SET utf8");   

                                        $cons2 = $mysqli->query("SELECT DISTINCT * FROM cr_tmoneda");
                                        while($rw = mysqli_fetch_object($cons2))
                                        {   $id_tm = $rw->cr_id_tm;
                                     ?>
                                        <tr  style="font-size: 11px; text-align: center;">
                                            
                                            <td><?php echo $rw->cr_nombre;?></td>
                                            <td><?php echo $rw->cr_abrev;?></td>
                                            
                                            <td>
                                                <a href="tm_borrar.php?id=<?php echo $id_tm;?>"><i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a>
                                            </td>
                                        </tr>
                                           <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                        <!-- FIN TABLA -->
                    </div>       
                </div>
            </div>

        <!-- FIN DE MODAL REG. TIPO MONEDA ------------------------------------------------------------------------------------------->

    <!-- FIN DE TABLA -->
<!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

     $(document).on('click', '.firma', function(){
                var codigo = $(this).attr("id");
                $.ajax({
                    url:"firma_oc.php",
                    method: "POST",
                    data:{codigo:codigo},
                    dataType:"json",  
                    success:function(data){

                        $("#oc").val(data.cr_id_oc);
                         $("#vmodal").modal('show');
                        //console.log(data.cr_num_oc);
                        
                   },
                
                })
            });


 $(document).ready(function () {
 var oTable = $('#example').dataTable({ stateSave: true }); 

 var allPages = oTable.fnGetNodes(); 
 $('body').on('click', '#checkTodo', function () { 
    if ($(this).hasClass('allChecked')) { 
        $('.checkbox', allPages).prop('checked', false); 
    } else { 
        $('.checkbox', allPages).prop('checked', true); }
        $(this).toggleClass('allChecked'); })

         });


$(document).ready(function() {
    $('#vender').click(function(){
        var selected =[];
            
        $('#form_oc .checkbox').each(function(){
            if (this.checked) {
                selected.push($(this).val());
            }
       

        });
        
      
                
        if (selected.length){  
            var data = JSON.stringify(selected);
     $.ajax({
     type: "POST",
     url: "vali_oc.php",
     data:  {data: data},  
     cache: false,
     
     success: function(data){
        console.log(data);
       
       
     }
 });
                 
              $("#vmodal").modal('show');


                
                
            }
                
        else
            alert('Debes seleccionar al menos una opción.');
            return false;
    });         
});    


</script>       
</body>
 </html>

<?php }else{
    header('location: https://www.ingema-sa.cl/control/'); 
    session_destroy();
    exit;
}   
 ?>
