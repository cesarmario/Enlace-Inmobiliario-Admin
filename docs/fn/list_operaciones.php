<?PHP
    include('conexion.php');
    $queryoperaciones = "SELECT * FROM operacion ORDER BY nombreOperacion ASC";
    $rtsoperaciones = mysqli_query($conexion, $queryoperaciones);
    $listado = "<table class='table table-striped' id='table1'>";
    $listado .= "<thead>";
    $listado .= "<tr>";
    $listado .= "<th>#</th>";
    $listado .= "<th>Nombre</th>";
    $listado .= "<th>Estado</th>";
    $listado .= "</tr>";
    $listado .= "</thead>";
    $listado .= "<tbody>";
    while($operaciones=mysqli_fetch_assoc($rtsoperaciones)){
        if($operaciones["baja"]==0){
            $estado="Activo";
            $btn="success";
        }else{
            $estado="Baja";
            $btn="danger";
        }
        
        $listado .= "<tr>";
        $listado .= "<td>". $operaciones['idOperacion'] . "</td>";
        $listado .= "<td>". $operaciones['nombreOperacion'] . "</td>";
        $listado .= "<td><span class='badge bg-success'>" . $estado . "</span></td>";
        $listado .= "</tr>";
    }
    $listado .= "</tbody>";
    $listado .= "</table>";
?>