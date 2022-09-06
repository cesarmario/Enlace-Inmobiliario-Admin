<?PHP
    session_start();
    include('fn/login_ctrl.php');
    include('fn/list_opciones.php');
    include('fn/datos_inmueble.php')
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion - EnlaceInmobiliario</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Inicio</span>
                            </a>
                        </li>

                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-house"></i>
                                <span>Inmuebles</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
                                    <a href="inmuebles.php"><i class="fa-solid fa-circle-chevron-right"></i>&nbsp;Inmuebles</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="consultas.php">Consultas</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="pedidos.php">Pedidos</a>
                                </li>                              
                            </ul>
                        </li>
                        
                        <li class="sidebar-item has-sub ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Datos</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item ">
                                    <a href="localidades.php">Localidades</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="operciones.php">Operaciones</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="propiedades.php">Propiedades</a>
                                </li>                                  
                            </ul>
                        </li>

                        <!-- Seccion Administrativa: Solo se habilita si el ROL del Usuario es Administrador -->
                        <?PHP if ($_SESSION['rolUsu'] =='1') { ?>
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-person-badge-fill"></i>
                                    <span>Permisos</span>
                                </a>
                                <ul class="submenu ">
                                <li class="submenu-item ">
                                        <a href="usuarios.php">Usuarios</a>
                                    </li>  
                                </ul>
                            </li>
                        <?PHP } else { ?>
                            <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Perfil</span>
                            </a>
                            <ul class="submenu ">
                            <li class="submenu-item ">
                                    <a href="usuario_abm.php?idUsuario=<?PHP echo $_SESSION['idUsu'];?>&abm=m">Mis Datos</a>
                                </li>  
                            </ul>
                        </li>    
                        <?PHP } ?>
                        <!-- /Seccion Administrativa-->

                        <li class="sidebar-item">
                            <a href="fn/logout.php" class='sidebar-link'>
                                <i class="bi bi-x-square"></i>
                                <span>Cerrar Sesi&oacute;n</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>ABM Inmueble</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!--div-- class="card-header">
                                        <h4>ABM Inmueble</h4>
                                    </!--div-->
                                    <div class="card-body">
                                        <div class="row">
                                            <form action="fn/abm_inmuebles.php" method="GET">
                                                <div class="col-md-8">
                                            
                                                    <div class="form-group">
                                                        <label for="basicInput">Titulo Inmueble</label>
                                                        <input type="text" class="form-control" id='tituloInmueble'	name='tituloInmueble'
                                                            placeholder="Titulo" value='<?PHP echo $tituloInmueble; ?>' require>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Tipo de Propiedad</label>
                                                        <select class="choices form-select" id='idPropiedad' name='idPropiedad' require>
                                                            <option value='<?PHP echo $idPropiedad; ?>'><?PHP echo $nombrePropiedad; ?></option>
                                                            <?PHP while($propiedad=mysqli_fetch_assoc($rtspropiedad)){?>
                                                            <option value="<?PHP echo $propiedad['idPropiedad']; ?>"> <?PHP echo $propiedad['nombrePropiedad'];?></option>
                                                            <?PHP } ?> 
                                                        </select>                                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Tipo de Operacion</label>
                                                        <select class="choices form-select" id='idOperacion' name='idOperacion'require>
                                                            <option value='<?PHP echo $idOperacion; ?>'><?PHP echo $nombreOperacion; ?></option>
                                                            <?PHP while($operacion=mysqli_fetch_assoc($rtsoperacion)){?>
                                                            <option value="<?PHP echo $operacion['idOperacion']; ?>"> <?PHP echo $operacion['nombreOperacion'];?></option>
                                                            <?PHP } ?> 
                                                        </select>                                    
                                                    </div>                                                  

                                                    <div class="form-group mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Descripcion Inmueble</label>
                                                        <textarea class="form-control" id='descripcionInmueble' name='descripcionInmueble'
                                                            rows="3"><?PHP echo $descripcionInmueble; ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Calle</label>
                                                        <input type="text" class="form-control" id='domicilioCalleInmueble' name='domicilioCalleInmueble'
                                                            placeholder="Domicilio" value='<?PHP echo $domicilioCalleInmueble; ?>' require>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">N&uacute;mero</label>
                                                        <input type="text" class="form-control" id='domicilioNumeroInmueble' name='domicilioNumeroInmueble'
                                                            placeholder="N&uacute;mero" value='<?PHP echo $domicilioNumeroInmueble; ?>'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Orientacion</label>
                                                        <select class="choices form-select" id='domicilioOrientacionInmueble' name='domicilioOrientacionInmueble'>
                                                            <option value='<?PHP echo $domicilioOrientacionInmueble; ?>'><?PHP echo $domicilioOrientacionInmueble; ?></option>
                                                            <option value="Este">Este</option>
                                                            <option value="Oeste">Oeste</option>
                                                            <option value="Norte">Norte</option>
                                                            <option value="Sur">Sur</option>
                                                        </select>                                    
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="basicInput">Localidad</label>
                                                        <select class="choices form-select" id='idLocalidad' name='idLocalidad' require>
                                                            <option value='<?PHP echo $idLocalidad; ?>'><?PHP echo $nombreLocalidad; ?></option>
                                                            <?PHP while($localidad=mysqli_fetch_assoc($rtslocalidad)){?>
                                                            <option value="<?PHP echo $localidad['idLocalidad']; ?>"> <?PHP echo $localidad['nombreLocalidad'];?></option>
                                                            <?PHP } ?> 
                                                        </select>                                    
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="basicInput">Habitaciones</label>
                                                        <input type="text" class="form-control" id='habitacionesInmueble' name='habitacionesInmueble'
                                                            placeholder="Habitaciones" value='<?PHP echo $habitacionesInmueble; ?>'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Baños</label>
                                                        <input type="text" class="form-control" id='banosInmueble' name='banosInmueble'
                                                            placeholder="Baños" value='<?PHP echo $banosInmueble; ?>'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Superficie Cubierta</label>
                                                        <input type="text" class="form-control" id='superficieCubiertaInmueble' name='superficieCubiertaInmueble'
                                                            placeholder="Superficie Cubierta" value='<?PHP echo $superficieCubiertaInmueble; ?>'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Superficie Total</label>
                                                        <input type="text" class="form-control" id='superficieTotalInmueble' name='superficieTotalInmueble'
                                                            placeholder="Superficie Total" value='<?PHP echo $superficieTotalInmueble; ?>'>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Informacion Adicional</label>
                                                        <textarea class="form-control" id='InformacionAdicionalInmueble' name='InformacionAdicionalInmueble' rows="3"><?PHP echo $informacionAdicionalInmueble; ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Valor Inmueble</label>
                                                        <input type="text" class="form-control" id='valorInmueble' name='valorInmueble'
                                                            placeholder="Valor" value='<?PHP echo $valorInmueble; ?>'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="basicInput">Moneda</label>
                                                    <select class="choices form-select" id='monedaInmueble' name='monedaInmueble'>
                                                            <option value='<?PHP echo $monedaInmueble; ?>'><?PHP echo $monedaInmueble; ?></option>
                                                            <option value="$">Pesos</option>
                                                            <option value="USD">Dolares</option>
                                                        </select>                                    
                                                    </div>
                                                </div>

                                                <div class="buttons">
                                                    <input type="hidden" id="idInmueble" name="idInmueble" value="<?PHP echo $_REQUEST['idInmueble']; ?>"/>
                                                    <input type="hidden" id="abm" name="abm" value="<?PHP echo $_REQUEST['abm']; ?>"/>
                                                    <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                                                    <!--button type="reset" class="btn btn-secondary me-1 mb-1">Reset</button-->
                                                    <a href="inmuebles.php" class="btn btn-warning me-1 mb-1">Cancelar</a>
                                                </div> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Enlace Inmobiliario</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/1ffc2bde27.js" crossorigin="anonymous"></script>                                                            
    <script src="assets/js/main.js"></script>
</body>

</html>