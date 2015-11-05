<?php
require_once('connectvars.php');

class NotificacionVoluntario {

    // Miembros de clase
    private $id, $id_actividad, $id_voluntario, $mensaje;

    /* 
     * Crear actividad:
     * Con un ID para obtener una notificacion ya existente
     * Con los demás valores y ID = NULL para crearla con ellos
     */
    function __construct($ID, $id_actividad, $id_voluntario, $mensaje) {
        if (!is_null($ID)) {
            $this->getNotificacion($ID);
        } else {
            $this->id = $this->existeNotificacion($id_voluntario, $mensaje);
            $this->id_actividad = $id_actividad;
            $this->id_voluntario = $id_voluntario;
            $this->mensaje = $mensaje;
        }
    }

    // Setter de mensaje
    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getIDactividad() {
        return $this->id_actividad;
    }

    function getIDvoluntario() {
        return $this->id_voluntario;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    // Obtener una notificacion según su ID
    function getNotificacion($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM NotificacionVoluntario WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->id_actividad = $row['ID_actividad'];
            $this->id_voluntario = $row['ID_voluntario'];
            $this->mensaje = $row['mensaje'];
        } else {
            echo '<p>Mensaje no encontrado</p>';
        }
        mysqli_close($dbc);
    }
    // Obtener la ultima ID en la tabla para asignar una nueva
    function getUltimaID() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM NotificacionVoluntario ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    // Revisar si el mensaje con el voluntario usado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa el ID
    function existeNotificacion($id_voluntario, $mensaje) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

    $query = "SELECT ID FROM NotificacionVoluntario WHERE ID_voluntario = $id_voluntario" .
            " and mensaje ='$mensaje'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }

    
    // Guardar la actividad actual en la base de datos
    function guardarNotificacion() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $mensaje = mysqli_real_escape_string($dbc, trim($this->mensaje));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO NotificacionVoluntario (ID, ID_actividad, ID_voluntario, mensaje)" .
                " VALUES ('$this->id', '$this->id_actividad', '$this->id_voluntario', '$mensaje')";
        } else {
            $query = "UPDATE NotificacionVoluntario SET mensaje='$mensaje' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '<p>Notificacion registrada satisfactoriamente</p>';
        mysqli_close($dbc);
    }
}
?>
