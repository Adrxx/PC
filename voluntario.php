<?php
require_once('actividad.php');
require_once('aliado.php');
require_once('competencia.php');
require_once('connectvars.php');
require_once('mensaje.php');
require_once('notificacion_voluntario.php');
require_once('voluntario_actividad.php');
require_once('global.php');

class Voluntario {

    // Miembros de clase
    private $id, $email, $password, $nombre, $apellido_paterno, 
        $apellido_materno, $fecha_nacimiento, $genero, $contacto,
        $ubicacion, $privacidad, $ocupacion, $habilidades_tecnicas,
        $color, $foto, $calificacion_total, $interes_uno, $interes_dos,
        $interes_tres;

    /* 
     * Crear voluntario:
     * Con un ID para obtener un voluntario ya existente
     * Con los demás valores y ID = NULL para crearlo con ellos
     */
    function __construct($ID, $email, $password, $nombre, $apellido_paterno,
        $apellido_materno, $fecha_nacimiento, $genero,
        $contacto, $ubicacion, $privacidad, $ocupacion,
        $habilidades_tecnicas, $color, $foto, $interes_uno,
        $interes_dos, $interes_tres) {
        if (!is_null($ID)) {
            $this->getVoluntario($ID);
        } else {
            $ID = $this->existeVoluntario($email);
            $this->id = $ID;
            $this->email = $email;
            $this->password = $password;
            $this->nombre = $nombre;
            $this->apellido_paterno = $apellido_paterno;
            $this->apellido_materno = $apellido_materno;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->genero = $genero;
            $this->contacto = $contacto;
            $this->ubicacion = $ubicacion;
            $this->privacidad = $privacidad;
            $this->ocupacion = $ocupacion;
            $this->habilidades_tecnicas = $habilidades_tecnicas;
            $this->color = $color;
            $this->foto = $foto;
            $this->calificacion_total = 0;
            $this->interes_uno = $interes_uno;
            $this->interes_dos = $interes_dos;
            $this->interes_tres = $interes_tres;
        }
    }

    // Setters de cada miembro menos ID
    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password= $password;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidoPaterno($apellido_paterno) {
        $this->apellido_paterno = $apellido_paterno;
    }

    function setApellidoMaterno($apellido_materno) {
        $this->apellido_materno = $apellido_materno;
    }

    function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento= $fecha_nacimiento;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setContacto($contacto) {
        $this->contacto = $contacto;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setPrivacidad($privacidad) {
        $this->privacidad = $privacidad;
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

    function setHabilidadesTecnicas($habilidades_tecnicas) {
        $this->habilidades_tecnicas = $habilidades_tecnicas;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setCalificacion($calificacion) {
        $this->calificacion_total = $calificacion;
    }

    function setIntereses($interes_uno, $interes_dos, $interes_tres) {
        $this->interes_uno = $interes_uno;
        $this->interes_dos = $interes_dos;
        $this->interes_tres = $interes_tres;
    }

    // Getters de cada miembro
    function getID() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidoPaterno() {
        return $this->apellido_paterno;
    }

    function getApellidoMaterno() {
        return $this->apellido_materno;
    }

    function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }

    function getGenero() {
        return $this->genero;
    }

    function getContacto() {
        return $this->contacto;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getPrivacidad() {
        return $this->privacidad;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function getHabilidadesTecnicas() {
        return $this->habilidades_tecnicas;
    }

    function getColor() {
        return $this->color;
    }

    function getFoto() {
        return $this->foto;
    }

    function getCalificacion() {
        return $this->calificacion_total;
    }

    function getIntereses() {
        return array(
            1 => $this->interes_uno,
            2 => $this->interes_dos,
            3 => $this->interes_tres,
        );
    }

    function getCompetencias() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Competencia WHERE ID_voluntario = '$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $competencias = [];
        foreach ($data as $row) {
            $competencias[$i] = new Competencia($row['ID']);
            $i++;
        }
        return $competencias;
    }

    function getMensajes() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Mensaje WHERE ID_voluntario = '$this->id'";
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

        $query = "SELECT ID FROM NotificacionVoluntario WHERE ID_voluntario = '$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $notificaciones = [];
        foreach ($data as $row) {
            $notificaciones[$i] = new NotificacionVoluntario($row['ID']);
            $i++;
        }
        return $notificaciones;
    }

    function getActividades() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM VoluntarioActividad WHERE ID_voluntario = '$this->id'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        $i = 0;
        $actividades = [];
        foreach ($data as $row) {
            $actividades[$i] = new VoluntarioActividad($row['ID']);
            $i++;
        }
        return $actividades;
    }

    // Obtener un voluntario según su ID
    function getVoluntario($ID) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT * FROM Voluntario WHERE ID = '$ID'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $this->id = $ID;
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->nombre = $row['nombre'];
            $this->apellido_paterno = $row['apellido_paterno'];
            $this->apellido_materno = $row['apellido_materno'];
            $this->fecha_nacimiento = $row['fecha_nacimiento'];
            $this->genero = $row['genero'];
            $this->contacto = $row['contacto'];
            $this->ubicacion = $row['ubicacion'];
            $this->privacidad = $row['privacidad'];
            $this->ocupacion = $row['ocupacion'];
            $this->habilidades_tecnicas = $row['habilidades_tecnicas'];
            $this->color = $row['color'];
            $this->foto = $row['foto'];
            $this->calificacion_total = $row['calificacion_total'];
            $this->interes_uno = $row['interes_uno'];
            $this->interes_dos = $row['interes_dos'];
            $this->interes_tres = $row['interes_tres'];
        } else {
            echo '<p>Voluntario no encontrado</p>';
        }
        mysqli_close($dbc);
    }

    // Obtener la ultima ID en la tabla para asignar una nueva
    function getUltimaID() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Voluntario ORDER BY ID DESC LIMIT 1";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        mysqli_close($dbc);
        return mysqli_fetch_array($data)['ID'];
    }

    // Revisar si el correo usado existe en la base de datos
    // Regresa NULL si no es encontrado, de otra manera regresa
    // el ID
    function existeVoluntario($email) {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        $query = "SELECT ID FROM Voluntario WHERE email='$email'";
        $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
        if (mysqli_num_rows($data) == 1) {
            return mysqli_fetch_array($data)['ID'];
        }
        return NULL;
    }

    // Guardar el voluntario actual en la base de datos
    function guardarVoluntario() {
        // Conectarse a la base de datos
        $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
            or die("ERROR!" . mysqli_error($dbc));

        // "Limpiar" los valores
        $email = mysqli_real_escape_string($dbc, trim($this->email));
        $password = mysqli_real_escape_string($dbc, trim($this->password));
        $nombre = mysqli_real_escape_string($dbc, trim($this->nombre));
        $apellido_paterno = mysqli_real_escape_string($dbc, trim($this->apellido_paterno));
        $apellido_materno = mysqli_real_escape_string($dbc, trim($this->apellido_materno));
        $fecha_nacimiento = mysqli_real_escape_string($dbc, trim($this->fecha_nacimiento));
        $genero = mysqli_real_escape_string($dbc, trim($this->genero));
        $contacto = mysqli_real_escape_string($dbc, trim($this->contacto));
        $ubicacion = mysqli_real_escape_string($dbc, trim($this->ubicacion));
        $privacidad = mysqli_real_escape_string($dbc, trim($this->privacidad));
        $ocupacion = mysqli_real_escape_string($dbc, trim($this->ocupacion));
        $habilidades_tecnicas = mysqli_real_escape_string($dbc, trim($this->habilidades_tecnicas));
        $color = mysqli_real_escape_string($dbc, trim($this->color));
        $foto = mysqli_real_escape_string($dbc, trim($this->foto));
        $calificacion = $this->calificacion_total;
        $interes_uno = mysqli_real_escape_string($dbc, trim($this->interes_uno));
        $interes_dos = mysqli_real_escape_string($dbc, trim($this->interes_dos));
        $interes_tres = mysqli_real_escape_string($dbc, trim($this->interes_tres));

        if (is_null($this->id)) { 
            $this->id = $this->getUltimaID() + 1;
            $query = "INSERT INTO Voluntario (ID, email, password, nombre, apellido_paterno," .
                " apellido_materno, fecha_nacimiento, genero, contacto, ubicacion," .
                " privacidad, ocupacion, habilidades_tecnicas, color, foto," .
                " calificacion_total, interes_uno, interes_dos, interes_tres)" .
                " VALUES ('$this->id', '$email', '$password', '$nombre', '$apellido_paterno'," .
                " '$apellido_materno', '$fecha_nacimiento', '$genero', '$contacto'," .
                " '$ubicacion', '$privacidad', '$ocupacion', '$habilidades_tecnicas'," .
                " '$color', '$foto', '$calificacion', '$interes_uno', '$interes_dos'," . 
                " '$interes_tres')";
        } else {
            $query = "UPDATE Voluntario SET password='$password', nombre='$nombre'," .
                " apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno'," .
                " fecha_nacimiento='$fecha_nacimiento', genero='$genero', contacto='$contacto', " .
                " ubicacion='$ubicacion', privacidad='$privacidad', ocupacion='$ocupacion'," .
                " habilidades_tecnicas='$habilidades_tecnicas', color='$color', foto='$foto'," .
                " calificacion_total='$calificacion', interes_uno='$interes_uno'," .
                " interes_dos='$interes_dos', interes_tres='$interes_tres' WHERE ID='$this->id'";
        }
        mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));

        echo '<p>Voluntario registrado satisfactoriamente</p>';
        mysqli_close($dbc);
    }

    // Aumentar la calificación en la cantidad dada
    function aumentarCalificacion($aumento) {
        $this->calificacion = $this->calificacion + $aumento;
    }

    function getActividadesRealizadas() {
        $actividades = $this->getActividades();
        $fecha_hoy = date("Y-m-d");
        $pasadas = [];
        $i=0;
        foreach ($actividades as $act) {
            $a = new Actividad($act->getIDActividad());
            if ($a->getFechaFinTrabajo() < $fecha_hoy) {
                $pasadas[$i] = $a;
                $i++;
            }
        }
        return $pasadas;
    }
	
	function getActividadesActivas() {
        $actividades = $this->getActividades();
        $fecha_hoy = date("Y-m-d");
        $pasadas = [];
        $i=0;
        foreach ($actividades as $act) {
            $a = new Actividad($act->getIDActividad());
            if ($a->getFechaFinTrabajo() >= $fecha_hoy) {
                $pasadas[$i] = $a;
                $i++;
            }
        }
        return $pasadas;
    }

    // Imprime las actividades a la pantalla con formato
	 function echoActividadesActivas() {
        $actividades = $this->getActividadesActivas();
		 if (!empty($actividades)) 
		{
			echo '<div class="titled_separator">Actividades Realizadas</div>';

		}
        foreach ($actividades as $act) {
            $act = new Actividad($act->getID());
			 $aliado = new Aliado($act->getIDAliado());
            echo '<div id="activity"><table id="header_activity">' . 
                '<tr>
				
				<td width="60">
				<div id="icono_interes_'.$aliado->getSector().'_color" class="categoria_activity"></div>
				</td>
				<td><div id="titulo_activity" style="color:'.$aliado->getColor().'" >' .
                $act->getNombre() .
                '</div> <a href="perfil_aliado.php?id='.$aliado->getID().'" id="subtitulo_activity">' .
                $aliado->getNombre() .
                '</a></td><td width="72">' .
                '<div id="fecha_activity" class="interface">' .
                '<div id="month">' .
                mesDeFecha($act->getFechaInicioTrabajo()) .
                '</div><div id="day">' .
                diaDeFecha($act->getFechaInicioTrabajo()) .
                '</div></div></td></tr></table><div class="separator">' .
                '</div><div id="content_activity" ><div id="descripcion_activity">' .
                $act->getDescripcion() .
                '</div><a href="evento.php?id='.$act->getID().'" id="visitar_button" style="background-color:'.$aliado->getColor().'" >P&aacute;gina del evento</a></div></div>';
        }
    }
	
	function echoActividadesInactivas()
	{
		
		$actividades = $this->getActividadesRealizadas();
		if (!empty($actividades)) 
		{
			echo '<div class="titled_separator">Actividades Relizadas</div>';

		}
        foreach ($actividades as $act) {
            $act = new Actividad($act->getID());
			 $aliado = new Aliado($act->getIDAliado());
            echo '<div id="activity"><table id="header_activity">' . 
                '<tr><td><div id="titulo_activity" style="color:'.$this->getColor().'" >' .
                $act->getNombre() .
                '</div> <div id="subtitulo_activity">' .
                $aliado->getNombre() .
                '</div></td><td width="72">' .
                '<div id="fecha_activity" class="interface">' .
                '<div id="month">' .
                mesDeFecha($act->getFechaInicioTrabajo()) .
                '</div><div id="day">' .
                diaDeFecha($act->getFechaInicioTrabajo()) .
                '</div></div></td></tr></table><div class="separator">' .
                '</div><div id="content_activity" ><div id="descripcion_activity">' .
                $act->getDescripcion() .
                '</div><a href="evento.php?id='.$act->getID().'" id="visitar_button" style="background-color:'.$this->getColor().'" >P&aacute;gina del evento</a></div></div>';
        }
		
	}

	
	function echoIntereses() {
			
			$intereses = $this->getIntereses();
			
			$titulo = "";
			
			echo '<tr>';
		
			for ($i = 1; $i < 4;$i++)
			{
				
				if (isset($intereses[$i]))
				{
					
					echo '<td> ';

						echo '<div id="icono_interes_'. $intereses[$i] .'_white" class="icono_interes"></div>';

					echo '</td>';
				
				}
				
			}
			
			echo '</tr>';
			echo '<tr>';
		
			for ($i = 1; $i < 4;$i++)
			{
				
				if (isset($intereses[$i]))
				{
					
					switch($intereses[$i])
					{
						case "medio":
							$titulo = "Medio Ambiente";						
							break;
						case "educacion":
							$titulo = "Educaci&oacute;n";						
							break;						
						case "salud":
							$titulo = "Salud";
							break;
						case "emprendimiento":
							$titulo = "Emprendimiento";
							break;
						case "deportes":
							$titulo = "Deportes y Recreaci&oacute;n";
							break;
						case "arte":
							$titulo = "Arte y Cultura";
							break;
						case "ciencia":
							$titulo = "Ciencia y tecnolog&iacute;a";
							break;
						
						case "derechos":
							$titulo = "Derechos Humanos";
							break;
						
					}
					
					echo '<td ';
					
					echo 'id="icono_interes_'.$intereses[$i].'_white" class="titulo_interes"> ';

					echo $titulo;
					
					echo '</td>';
					

				}
				
			}
		
			echo '</tr>';

			
			
			
			
	}
	
	function echoCompetencias()
	{
		$competencias = $this->getCompetencias();
		
		
		
		echo '[';

		for ($i = 0; $i < count($competencias); $i++)
		{

				$comp = $competencias[$i];
				$puntaje = $comp->getPuntaje();

				echo $puntaje;

				if ($i != (count($competencias)-1))
				{
					echo ',';
				}

		}

		echo '],[';
		
		for ($i = 0; $i < count($competencias);$i++)
		{

				$comp = $competencias[$i];
				$nombre = $comp->getNombre();

				echo '"'.$nombre.'"';

				if ($i != (count($competencias)-1))
				{
					echo ',';
				}

		}
		echo ']';
		
		
	}
	
}

function findVoluntarioByEmail($email) {
    $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
        or die("ERROR!" . mysqli_error($dbc));
    $query = "SELECT ID FROM Voluntario WHERE email='$email'";
    $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
    $row = mysqli_fetch_array($data);
    return $row["ID"];
}

function makeSession($email, $password) {
    $voluntario = new Voluntario(findVoluntarioByEmail($email));
    if ($voluntario->getPassword() == $password) {
		return $voluntario->getID();
    }
	return null;
}
?>
