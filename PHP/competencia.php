<?php
require_once('connectvars.php');

class Competencia {

    // Miembros de clase
    private $id, $id_voluntario, $nombre, $puntaje; 

    /* 
     * Crear competencia:
     * Con un ID para obtener una competencia ya existente
     * Con los demás valores y ID = NULL para crearla con ellos
     */
    function __construct($ID, $id_voluntario, $nombre, $puntaje) {
        if (!is_null($ID)) {
            $this->getCompetencia($ID);
        } else {
            $ID = $this->existeCompetencia($id_voluntario, $nombre);
            $this->id = $ID;
            $this->id_voluntario = $id_voluntario;
            $this->nombre = $nombre;
            $this->puntaje = $puntaje;
        }
    }

    // Setters de cada miembro menos ID y ID_voluntario
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPuntaje($puntaje) {
        $this->puntaje = $puntaje; 
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getIDVoluntario() {
        return $this->id_voluntario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPuntaje() {
        return $this->puntaje;
    }

    // Obtener una competencia según su ID
    function getCompetencia($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM Competencia WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->id_voluntario = $row['ID_voluntario'];
            $this->nombre = $row['nombre'];
            $this->puntaje = $row['puntaje'];
        } else {
            echo '<p>Competencia no encontrada</p>';
        }
        mysqli_close($dbc);
    }

    // Obtener la ultima ID en la tabla para asignar una nueva
    function getUltimaID() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Competencia ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    
    // Revisar si la competencia de nombre dado existe para el voluntario dado.
    // Regresa NULL si no es encontrada, de otra manera regresa el ID
    function existeCompetencia($id_voluntario, $nombre) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Competencia WHERE ID_voluntario='$id_voluntario'" .
                " and nombre='$nombre'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }

    // Guardar la competencia actual en la base de datos
    function guardarCompetencia() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $nombre = mysqli_real_escape_string($dbc, trim($this->nombre));
        $puntaje = mysqli_real_escape_string($dbc, trim($this->puntaje));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO Competencia (ID, ID_voluntario, nombre, puntaje)" .
                " VALUES ('$this->id', '$this->id_voluntario', '$nombre', '$puntaje')";
        } else {
            $query = "UPDATE Competencia SET nombre='$nombre', puntaje='$puntaje'" .
                " WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '<p>Competencia registrada satisfactoriamente</p>';
        mysqli_close($dbc);
    }
}
?>
