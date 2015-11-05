<?php
require_once('connectvars.php');

class NotificacionAliado {

    // Miembros de clase
    private $id, $id_aliado, $mensaje;

    /* 
     * Crear actividad:
     * Con un ID para obtener una notificacion ya existente
     * Con los demás valores y ID = NULL para crearla con ellos
     */
    function __construct($ID, $id_aliado, $mensaje) {
        if (!is_null($ID)) {
            $this->getNotificacion($ID);
        } else {
            $this->id = $this->existeNotificacion($id_aliado, $mensaje);
            $this->id_aliado = $id_aliado;
            $this->mensaje = $mensaje;
        }
    }

    // Setter de mensaje
    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    // Getters de cada miembro
    function getID() {
        echo $this->id . "<br />";
    }

    function getIDAliado() {
        echo $this->id_aliado . "<br />";
    }

    function getMensaje() {
        echo $this->mensaje. "<br />";
    }

    // Obtener una notificacion según su ID
    function getNotificacion($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM NotificacionAliado WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->id_aliado = $row['ID_aliado'];
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

        $query = "SELECT ID FROM NotificacionAliado ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    // Revisar si el mensaje con el aliado usado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa el ID
    function existeNotificacion($id_aliado, $mensaje) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

    $query = "SELECT ID FROM NotificacionAliado WHERE ID_aliado = $id_aliado" .
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
            $query = "INSERT INTO NotificacionAliado (ID, ID_aliado, mensaje)" .
                " VALUES ('$this->id', '$this->id_aliado', '$mensaje')";
        } else {
            $query = "UPDATE NotificacionAliado SET mensaje='$mensaje' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '<p>Notificacion registrada satisfactoriamente</p>';
        mysqli_close($dbc);
    }
}
?>
