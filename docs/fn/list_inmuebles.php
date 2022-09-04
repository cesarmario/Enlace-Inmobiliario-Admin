<?PHP
    include('conexion.php');
    $queryinmuebles = "SELECT * FROM vista_inmuebles ORDER BY fecha DESC";
    $rtsinmuebles = mysqli_query($conexion, $queryinmuebles);

    $domicilio = "";
    if(!empty($inmuebles['domicilioNumeroInmueble'])){$domicilio .= " " . $inmuebles['domicilioNumeroInmueble'];}
    if(!empty($inmuebles['domicilioOrientacionInmueble'])){$domicilio .= " " . $inmuebles['domicilioOrientacionInmueble'];}

    $listado = "<table class='table table-striped' id='table1'>";
    $listado .= "<thead>";
    $listado .= "<tr>";
    $listado .= "<th>Operacion</th>";
    $listado .= "<th>Propiedad</th>";
    $listado .= "<th>Titulo</th>";
    $listado .= "<th>Domicilio</th>";
    $listado .= "<th>Localidad</th>";
    $listado .= "<th>Valor</th>";
    $listado .= "<th>Agente</th>";
    $listado .= "<th></th>";
    $listado .= "<th></th>";
    $listado .= "</tr>";
    $listado .= "</thead>";
    $listado .= "<tbody>";
    while($inmuebles=mysqli_fetch_assoc($rtsinmuebles)){
        $listado .= "<tr>";
        $listado .= "<td>". $inmuebles['nombreOperacion'] . "</td>";
        $listado .= "<td>". $inmuebles['nombrePropiedad'] . "</td>";
        $listado .= "<td>". $inmuebles['tituloInmueble'] . "</td>";
        $listado .= "<td>". $inmuebles['domicilioCalleInmueble'] . $domicilio . "</td>";
        $listado .= "<td>". $inmuebles['nombreLocalidad'] . "</td>";
        $listado .= "<td><b>". $inmuebles['monedaInmueble'] . "</b>&nbsp;". $inmuebles['valorInmueble'] . "</td>";
        $listado .= "<td><b>". $inmuebles['nombreAgente'] . "</td>";
        $listado .= "<td><a href='inmueble_abm_img.php?idInmueble=". $inmuebles['idInmueble'] ."' class='btn btn-warning me-1 mb-1'>Imagenes</a></td>";
        $listado .= "<td><a href='inmueble_abm.php?idInmueble=". $inmuebles['idInmueble'] . "&abm=m' class='btn btn-info me-1 mb-1'>Editar</a></td>";
        $listado .= "</tr>";
    }
    $listado .= "</tbody>";
    $listado .= "</table>";
?>
