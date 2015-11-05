<?php
require_once('connectvars.php');

class Mensaje {

    // Miembros de clase
    private $id, $id_voluntario, $id_aliado, $texto;

    /* 
     * Crear Mensaje:
     * Con un ID para obtener un mensaje ya existente
     * Con los demás valores y ID = NULL para crearlo con ellos
     */
    function __construct($ID, $id_voluntario, $id_aliado, $texto) {
        if (!is_null($ID)) {
            $this->getMensaje($ID);
        } else {
            $this->id = $this->existeMensaje($id_voluntario, $id_aliado, $texto);
            $this->id_voluntario = $id_voluntario;
            $this->id_aliado = $id_aliado;
            $this->texto = $texto;
        }
    }

    // Setter de mensaje
    function setMensaje($texto) {
        $this->texto = $texto;
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getIDVoluntario() {
        return $this->id_voluntario;
    }

    function getIDAliado() {
        return $this->id_aliado;
    }

    function getTexto() {
        return $this->texto;
    }

    // Obtener un mensaje según su ID
    function getMensaje($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM Mensaje WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->id_voluntario = $row['ID_voluntario'];
            $this->id_aliado = $row['ID_aliado'];
            $this->texto = $row['mensaje'];
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

        $query = "SELECT ID FROM Mensaje ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    // Revisar si el mensaje de voluntario a aliado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa el ID
    function existeMensaje($id_voluntario, $id_aliado, $texto) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Mensaje WHERE ID_voluntario='$id_voluntario' and" .
                    " ID_aliado='$id_aliado' and mensaje='$texto'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }
    
    // Guardar el mensaje actual en la base de datos
    function guardarMensaje() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $texto = mysqli_real_escape_string($dbc, trim($this->texto));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO Mensaje (ID, ID_voluntario, ID_aliado, mensaje)" .
                " VALUES ('$this->id', '$this->id_voluntario', '$this->id_aliado', '$texto')";
        } else {
            $query = "UPDATE Mensaje SET mensaje='$texto' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '<p>Mensaje registrado satisfactoriamente</p>';
        mysqli_close($dbc);
    }
}
?>
