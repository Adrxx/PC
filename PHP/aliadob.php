<?php
require_once('actividad.php');
require_once('aliado.php');
require_once('competencia.php');
require_once('connectvars.php');
require_once('mensaje.php');
require_once('notificacion_aliado.php');

class Aliado {

    // Miembros de clase
    private $id, $nombre, $sector, $subsector_uno, $subsector_dos, 
        $biografia, $descripcion, $contacto, $rating, $foto_perfil,
        $foto_portada;

    /* 
     * Crear aliado:
     * Con un ID para obtener un aliado ya existente
     * Con los demás valores y ID = NULL para crearlo con ellos
     */
    function __construct($ID, $nombre, $sector, $subsector_uno, 
        $subsector_dos, $biografia, $descripcion, $contacto, 
        $rating, $foto_perfil, $foto_portada) {
        if (!is_null($ID)) {
            $this->getAliado($ID);
        } else {
            $ID = $this->existeAliado($nombre);
            $this->id = $ID;
            $this->nombre = $nombre;
            $this->sector = $sector;
            $this->subsector_uno = $subsector_uno;
            $this->subsector_dos = $subsector_dos;
            $this->biografia = $biografia;
            $this->descripcion = $descripcion;
            $this->contacto = $contacto;
            $this->rating = $rating;
            $this->foto_perfil = $foto_perfil;
            $this->foto_portada = $foto_portada;
        }
    }

    // Setters de cada miembro menos ID
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }

    function setSubsectorUno($subsector_uno) {
        $this->subsector_uno = $subsector_uno;
    }

    function setSubsectorDos($subsector_dos) {
        $this->subsector_dos = $subsector_dos;
    }

    function setBiografia($biografia) {
        $this->biografia = $biografia;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setContacto($contacto) {
        $this->contacto = $contacto;
    }

    function setRating($rating) {
        $this->rating = $rating;
    }

    function setFotoPerfil($foto_perfil) {
        $this->foto_perfil = $foto_perfil;
    }

    function setFotoPortada($foto_portada) {
        $this->foto_portada = $foto_portada;
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSector($sector) {
        return $this->sector;
    }

    function getSubsectorUno($subsector_uno) {
        return $this->subsector_uno;
    }

    function getSubsectorDos($subsector_dos) {
        return $this->subsector_dos;
    }

    function getBiografia($biografia) {
        return $this->biografia;
    }

    function getDescripcion($descripcion) {
        return $this->descripcion;
    }

    function getContacto($contacto) {
        return $this->contacto;
    }

    function getRating($rating) {
        return $this->rating;
    }

    function getFotoPerfil($foto_perfil) {
        return $this->foto_perfil;
    }

    function getFotoPortada($foto_portada) {
        return $this->foto_portada;
    }

    function getActividades() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Actividad WHERE ID_aliado = '$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $actividades = [];
        foreach ($data as $row) {
            $actividades[$i] = new Actividad($row['ID']);
            $i++;
        }
        return $actividades;
    }

    function getMensajes() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Mensaje WHERE ID_aliado = '$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $mensajes = [];
        foreach ($data as $row) {
            $mensajes[$i] = new Mensaje($row['ID']);
            $i++;
        }
        return $mensajes;
    }

    function getNotificaciones() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM NotificacionAliado WHERE ID_aliado = '$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $notificaciones = [];
        foreach ($data as $row) {
            $notificaciones[$i] = new NotificacionAliado($row['ID']);
            $i++;
        }
        return $notificaciones;
    }

    // Obtener un aliado según su ID
    function getAliado($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM Aliado WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->nombre = $row['nombre'];
            $this->sector = $row['sector'];
            $this->subsector_uno = $row['subsector_uno'];
            $this->subsector_dos = $row['subsector_dos'];
            $this->biografia = $row['biografia'];
            $this->descripcion = $row['descripcion'];
            $this->contacto = $row['contacto'];
            $this->rating = $row['rating'];
            $this->foto_perfil = $row['foto_perfil'];
            $this->foto_portada = $row['foto_portada'];
        } else {
            echo '<p>Aliado no encontrado</p>';
        }
        mysqli_close($dbc);
    }

    // Obtener la ultima ID en la tabla para asignar una nueva
    function getUltimaID() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Aliado ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    
    // Revisar si el nombre usado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa
    // el ID
    function existeAliado($nombre) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Aliado WHERE nombre='$nombre'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }

    // Guardar el aliado actual en la base de datos
    function guardarAliado() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $nombre = mysqli_real_escape_string($dbc, trim($this->nombre)); 
        $sector = mysqli_real_escape_string($dbc, trim($this->sector));
        $subsector_uno = mysqli_real_escape_string($dbc, trim($this->subsector_uno));
        $subsector_dos = mysqli_real_escape_string($dbc, trim($this->subsector_dos));
        $biografia = mysqli_real_escape_string($dbc, trim($this->biografia));
        $descripcion = mysqli_real_escape_string($dbc, trim($this->descripcion));
        $contacto = mysqli_real_escape_string($dbc, trim($this->contacto));
        $rating = mysqli_real_escape_string($dbc, trim($this->rating));
        $foto_perfil = mysqli_real_escape_string($dbc, trim($this->foto_perfil));
        $foto_portada = mysqli_real_escape_string($dbc, trim($this->foto_portada));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO Aliado (ID, nombre, sector, subsector_uno," .
                " subsector_dos, biografia, descripcion, contacto, rating," .
                " foto_perfil, foto_portada)" .
                " VALUES ('$this->id', '$nombre', '$sector', '$subsector_uno', '$subsector_dos'," . 
                " '$biografia', '$descripcion', '$contacto', '$rating', '$foto_perfil'," .
                " '$foto_portada')";
        } else {
            $query = "UPDATE Aliado SET sector='$sector', subsector_uno='$subsector_uno'," .
                " subsector_dos='$subsector_dos', biografia='$biografia'," .
                " descripcion='$descripcion', contacto='$contacto', rating='$rating'," .
                " foto_perfil='$foto_perfil', foto_portada='$foto_portada' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '<p>Aliado registrado satisfactoriamente</p>';
        mysqli_close($dbc);
    }

    // Aumentar rating en la cantidad especificada
    function aumentarRating($aumento) {
        $this->rating = $this->rating + $aumento;
    }
	
	

}

?>
