<?php
require_once('connectvars.php');
require_once('notificacion_voluntario.php');
require_once("voluntario_actividad.php");


class Actividad {

    // Miembros de clase
    private $id, $id_aliado, $nombre, $objetivo, 
        $descripcion, $publico_objetivo, $habilidades_requeridas,
        $fecha_inicio_inscripcion, $fecha_fin_inscripcion,
        $fecha_inicio_trabajo, $fecha_fin_trabajo, $ubicacion,
        $foto_uno, $foto_dos, $foto_tres, $foto_cuatro, 
        $voluntarios_requeridos, $provisiones, $recompensas;

    /* 
     * Crear actividad:
     * Con un ID para obtener una actividad ya existente
     * Con los demás valores y ID = NULL para crearla con ellos
     */
    function __construct($ID, $id_aliado, $nombre, $objetivo,
        $descripcion, $publico_objetivo, $habilidades_requeridas,
        $fecha_inicio_inscripcion, $fecha_fin_inscripcion,
        $fecha_inicio_trabajo, $fecha_fin_trabajo, $ubicacion,
        $foto_uno, $foto_dos, $foto_tres, $foto_cuatro, 
        $voluntarios_requeridos, $provisiones, $recompensas) {
        if (!is_null($ID)) {
            $this->getActividad($ID);
        } else {
            $ID = $this->existeActividad($nombre);
            $this->id = $ID;
            $this->id_aliado = $id_aliado;
            $this->nombre = $nombre;
            $this->objetivo = $objetivo;
            $this->descripcion = $descripcion;
            $this->publico_objetivo = $publico_objetivo;
            $this->habilidades_requeridas = $habilidades_requeridas;
            $this->fecha_inicio_inscripcion = $fecha_inicio_inscripcion;
            $this->fecha_fin_inscripcion = $fecha_fin_inscripcion;
            $this->fecha_inicio_trabajo = $fecha_inicio_trabajo;
            $this->fecha_fin_trabajo = $fecha_fin_trabajo;
            $this->ubicacion = $ubicacion;
            $this->foto_uno = $foto_uno;
            $this->foto_dos = $foto_dos;
            $this->foto_tres = $foto_tres;
            $this->foto_cuatro = $foto_cuatro;
            $this->voluntarios_requeridos = $voluntarios_requeridos;
            $this->provisiones = $provisiones;
            $this->recompensas = $recompensas;
        }
    }

    // Setters de cada miembro menos ID y ID_aliado
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPublicoObjetivo($publico_objetivo) {
        $this->publico_objetivo = $publico_objetivo;
    }

    function setHabilidadesRequeridas($habilidades_requeridas) {
        $this->habilidades_requeridas = $habilidades_requeridas;
    }

    function setFechaInicioInscripcion($fecha_inicio_inscripcion) {
        $this->fecha_inicio_inscripcion = $fecha_inicio_inscripcion;
    }

    function setFechaFinInscripcion($fecha_fin_inscripcion) {
        $this->fecha_fin_inscripcion = $fecha_fin_inscripcion;
    }

    function setFechaInicioTrabajo($fecha_inicio_trabajo) {
        $this->fecha_inicio_trabajo = $fecha_inicio_trabajo;
    }

    function setFechaFinTrabajo($fecha_fin_trabajo) {
        $this->fecha_fin_trabajo = $fecha_fin_trabajo;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setFotoUno($foto) {
        $this->foto_uno = $foto;
    }

    function setFotoDos($foto) {
        $this->foto_dos = $foto;
    }

    function setFotoTres($foto) {
        $this->foto_tres = $foto;
    }

    function setFotoCuatro($foto) {
        $this->foto_cuatro = $foto;
    }

    function setVoluntariosRequeridos($voluntarios_requeridos) {
        $this->voluntarios_requeridos = $voluntarios_requeridos;
    }

    function setProvisiones($provisiones) {
        $this->provisiones = $provisiones;
    }

    function setRecompensas($recompensas) {
        $this->recompensas = $recompensas;
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getIDAliado() {
        return $this->id_aliado;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getObjetivo() {
        return $this->objetivo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPublicoObjetivo() {
        return $this->publico_objetivo;
    }

    function getHabilidadesRequeridas() {
        return $this->habilidades_requeridas;
    }

    function getFechaInicioInscripcion() {
        return $this->fecha_inicio_inscripcion;
    }

    function getFechaFinInscripcion() {
        return $this->fecha_fin_inscripcion;
    }

    function getFechaInicioTrabajo() {
        return $this->fecha_inicio_trabajo;
    }

    function getFechaFinTrabajo() {
        return $this->fecha_fin_trabajo;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getFotos() {
        return array(
                1 => $this->foto_uno,
                2 => $this->foto_dos,
                3 => $this->foto_tres,
                4 => $this->foto_cuatro
                );
    }

    function getVoluntariosRequeridos() {
        return $this->voluntarios_requeridos;
    }

    function getProvisiones() {
        return $this->provisiones;
    }

    function getRecompensas() {
        return $this->recompensas;
    }

    function getVoluntarios() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM VoluntarioActividad WHERE ID_actividad='$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $voluntarios = [];
        foreach ($data as $row) {
            $voluntarios[$i] = new VoluntarioActividad($row['ID']);
            $i++;
        }
        return $voluntarios;
    }

    function getNotificaciones() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM NotificacionVoluntario WHERE ID_actividad='$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $notificaciones = [];
        foreach ($data as $row) {
            $notificaciones[$i] = new NotificacionVoluntario($row['ID']);
            $i++;
        }
        return $notificaciones;
    }

    // Obtener una actividad según su ID
    function getActividad($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM Actividad WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->id_aliado = $row['ID_aliado'];
            $this->nombre = $row['nombre'];
            $this->objetivo = $row['objetivo'];
            $this->descripcion = $row['descripcion'];
            $this->publico_objetivo = $row['publico_objetivo'];
            $this->habilidades_requeridas = $row['habilidades_requeridas'];
            $this->fecha_inicio_inscripcion = $row['fecha_inicio_inscripcion'];
            $this->fecha_fin_inscripcion = $row['fecha_fin_inscripcion'];
            $this->fecha_inicio_trabajo = $row['fecha_inicio_trabajo'];
            $this->fecha_fin_trabajo = $row['fecha_fin_trabajo'];
            $this->ubicacion = $row['ubicacion'];
            $this->foto_uno = $row['foto_uno'];
            $this->foto_dos = $row['foto_dos'];
            $this->foto_tres = $row['foto_tres'];
            $this->foto_cuatro = $row['foto_cuatro'];
            $this->voluntarios_requeridos = $row['voluntarios_requeridos'];
            $this->provisiones = $row['provisiones'];
            $this->recompensas = $row['recompensas'];
        } else {
            echo '';
        }
        mysqli_close($dbc);
    }

    // Obtener la ultima ID en la tabla para asignar una nueva
    function getUltimaID() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Actividad ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }
    
    // Revisar si el nombre usado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa el ID
    function existeActividad($nombre) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Actividad WHERE nombre='$nombre'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }

    function crearNotificacion($titulo,$mensaje,$fecha_creacion) {
		
        $voluntarios = $this->getVoluntarios();
        foreach ($voluntarios as $v) {
            $m = new NotificacionVoluntario(NULL, $this->getID(), $v->getID(),$titulo,$fecha_creacion, $mensaje);
            $m->guardarNotificacion();
        }
    }

    // Guardar la actividad actual en la base de datos
    function guardarActividad() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $id_aliado = mysqli_real_escape_string($dbc, trim($this->id_aliado));
        $nombre = mysqli_real_escape_string($dbc, trim($this->nombre));
        $objetivo = mysqli_real_escape_string($dbc, trim($this->objetivo));
        $descripcion = mysqli_real_escape_string($dbc, trim($this->descripcion));
        $publico_objetivo = mysqli_real_escape_string($dbc, trim($this->publico_objetivo));
        $habilidades_requeridas = mysqli_real_escape_string($dbc, trim($this->habilidades_requeridas));
        $fecha_inicio_inscripcion = mysqli_real_escape_string($dbc, trim($this->fecha_inicio_inscripcion));
        $fecha_fin_inscripcion = mysqli_real_escape_string($dbc, trim($this->fecha_fin_inscripcion));
        $fecha_inicio_trabajo = mysqli_real_escape_string($dbc, trim($this->fecha_inicio_trabajo));
        $fecha_fin_trabajo = mysqli_real_escape_string($dbc, trim($this->fecha_fin_trabajo));
        $ubicacion = mysqli_real_escape_string($dbc, trim($this->ubicacion));
        $foto_uno = mysqli_real_escape_string($dbc, trim($this->foto_uno));
        $foto_dos = mysqli_real_escape_string($dbc, trim($this->foto_dos));
        $foto_tres = mysqli_real_escape_string($dbc, trim($this->foto_tres));
        $foto_cuatro = mysqli_real_escape_string($dbc, trim($this->foto_cuatro));
        $voluntarios_requeridos = mysqli_real_escape_string($dbc, trim($this->voluntarios_requeridos));
        $provisiones = mysqli_real_escape_string($dbc, trim($this->provisiones));
        $recompensas = mysqli_real_escape_string($dbc, trim($this->recompensas));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO Actividad (ID, ID_aliado, nombre, objetivo, descripcion," .
                " publico_objetivo, habilidades_requeridas, fecha_inicio_inscripcion," .
                " fecha_fin_inscripcion, fecha_inicio_trabajo, fecha_fin_trabajo, ubicacion," .
                " foto_uno, foto_dos, foto_tres, foto_cuatro, voluntarios_requeridos, provisiones," .
                " recompensas)" .
                " VALUES ('$this->id', '$this->id_aliado', '$nombre', '$objetivo', '$descripcion'," .
                " '$publico_objetivo', '$habilidades_requeridas', '$fecha_inicio_inscripcion'," .
                " '$fecha_fin_inscripcion', '$fecha_inicio_trabajo', '$fecha_fin_trabajo'," .
                " '$ubicacion', '$foto_uno', '$foto_dos', '$foto_tres', '$foto_cuatro'," .
                " '$voluntarios_requeridos', '$provisiones', '$recompensas')";
        } else {
            $query = "UPDATE Actividad SET" .
                " objetivo='$objetivo'," .
                " descripcion='$descripcion'," .
                " publico_objetivo='$publico_objetivo'," .
                " habilidades_requeridas='$habilidades_requeridas'," . 
                " fecha_inicio_inscripcion='$fecha_inicio_inscripcion'," .
                " fecha_fin_inscripcion='$fecha_fin_inscripcion'," .
                " fecha_inicio_trabajo='$fecha_inicio_trabajo'," .
                " fecha_fin_trabajo='$fecha_fin_trabajo'," .
                " ubicacion='$ubicacion'," .
                " foto_uno='$foto_uno'," .
                " foto_dos='$foto_dos'," .
                " foto_tres='$foto_tres'," .
                " foto_cuatro='$foto_cuatro'," .
                " voluntarios_requeridos='$voluntarios_requeridos'," .
                " provisiones='$provisiones'," .
                " recompensas='$recompensas' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '';
        mysqli_close($dbc);
    }
	
	function echoAvisos()
	{
		
		$notificaciones = $this->getNotificaciones();

		foreach($notificaciones as $noti)
		{
			
			echo '<div class="titled_separator">Anuncios</div>
					
					<div id="activity">
					
						<table id="header_activity">

							<tr> 						

								<td>
									<div id="titulo_activity">'. $noti->getTitulo() .'</div> 
								</td>
								<td width="72">
									<div id="fecha_activity" class="interface">
										<div id="month">'.mesDeFecha($noti->getFechaCreacion()).'</div>
										<div id="day">'.diaDeFecha($noti->getFechaCreacion()).'</div>
									</div>
								</td>
							</tr>

						</table>

					
					<div class="separator"></div>
					
					<div id="content_activity" >

						<div id="descripcion_activity">'.$noti->getMensaje().'

				

						</div>
					
					
	

					</div>
					
					<div id="untitled_separator"></div>';
			
			
	
			
		}
		
		
		
		
	}
	
	
}

?>
