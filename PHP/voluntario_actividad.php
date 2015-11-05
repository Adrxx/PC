<?php
require_once('connectvars.php');

class VoluntarioActividad {

    // Miembros de clase
    private $id, $id_voluntario, $id_actividad, $aprobacion, $calificacion;

    /* 
     * Crear actividad:
     * Con un ID para obtener una actividad ya existente
     * Con los demás valores y ID = NULL para crearla con ellos
     */
    function __construct($ID, $id_voluntario, $id_actividad, $aprobacion, $calificacion) {
        if (!is_null($ID)) {
            $this->getActividad($ID);
        } else {
            $ID = $this->existeVoluntarioActividad($id_voluntario, $id_actividad);
            $this->id = $ID;
            $this->id_voluntario = $id_voluntario;
            $this->id_actividad = $id_actividad;
            $this->aprobacion = $aprobacion;
            $this->calificacion = $calificacion;
        }
    }

    // Setters de aprobacion y calificacion
    function setAprobacion($aprobacion) {
        $this->aprobacion = $aprobacion;
    }

    function setCalificacion($calificacion) {
        $this->calificacion = $calificacion;
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getIDVoluntario() {
        return $this->id_voluntario;
    }

    function getIDActividad() {
        return $this->id_actividad;
    }

    function getAprobacion() {
        return $this->aprobacion;
    }

    function getCalificacion() {
        return $this->calificacion;
    }

    // Obtener un VoluntarioActividad según su ID
    function getActividad($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM VoluntarioActividad WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->id_voluntario = $row['ID_voluntario'];
            $this->id_actividad = $row['ID_actividad'];
            $this->aprobacion = $row['aprobacion'];
            $this->calificacion = $row['calificacion'];
        } else {
            echo '<p>VoluntarioActividad no encontrada</p>';
        }
        mysqli_close($dbc);
    }

    // Obtener la ultima ID en la tabla para asignar una nueva
    function getUltimaID() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM VoluntarioActividad ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    
    // Revisar si el id_voluntario con el id_actividad usado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa el ID
    function existeVoluntarioActividad($id_voluntario, $id_actividad) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM VoluntarioActividad WHERE ID_voluntario='$id_voluntario' and" .
            " ID_actividad='$id_actividad'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }

    // Guardar la actividad actual en la base de datos
    function guardarActividad() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $aprobacion = mysqli_real_escape_string($dbc, trim($this->aprobacion));
        $calificacion = mysqli_real_escape_string($dbc, trim($this->calificacion));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO VoluntarioActividad (ID, ID_voluntario, ID_actividad," .
                " aprobacion, calificacion)" .
                " VALUES ('$this->id', '$this->id_voluntario', '$this->id_actividad'," .
                " '$aprobacion', '$calificacion')";
        } else {
            $query = "UPDATE VoluntarioActividad SET aprobacion='$aprobacion', " .
                    " calificacion='$calificacion' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

       // echo '<p>VoluntarioActividad registrada satisfactoriamente</p>';
        mysqli_close($dbc);
    }
}
?>
