<?php
require_once('connectvars.php');
require_once('actividad.php');
require_once('global.php');

function buscar($interes, $texto) {
    $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
        or die("ERROR!" . mysqli_error($dbc));
    $query = "";
    $actividades = [];
    $i=0;
    if (!is_null($interes)) {
        $query = "SELECT ID FROM Aliado WHERE sector='$interes'" .
            " or subsector_uno='$interes' or subsector_dos='$interes'";
        if (!is_null($texto)) {
            $query = "SELECT ID FROM Actividad WHERE descripcion LIKE '%$texto%' " .
                " and ID_aliado IN (" . $query . ")";
        }
    } else {
        $query = "SELECT ID FROM Actividad WHERE descripcion LIKE %{'$texto'}%";
    }
    $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
    foreach($data as $d) {
        foreach($d as $id) {
            $actividades[$i] = new Actividad($id);
            $i++;
        }
    }
    return getActividadesDisponibles($actividades,true);
}


?>
