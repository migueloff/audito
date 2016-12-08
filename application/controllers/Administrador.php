<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Administrador extends Ci_Controller{

		public function __construct(){
			parent:: __construct();
			session_start();
			$this->load->helper('url');
    		$this->load->model('mod_usuarios');
    		$this->load->library('grocery_CRUD');
    		error_reporting(E_ERROR | E_PARSE);
		}

		public function salida_datos($output= null){

			$this->load->view('head');
      		$this->load->view('headers/header_administrador');
			$this->load->view('administrador/admini_profesores.php',$output);
		}

		public function index(){

			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/noticias');
		}
		//ADMINISTRA A LOS PROFESORES
		public function admin_profesor(){

			$crud = new grocery_CRUD();

			$crud->where('tipo','Profesor');

			$crud->set_language('spanish');
			$crud->set_subject('Profesor');
			//$crud->set_theme('datatables');
			$crud->set_table('usuarios');

			$crud->columns('rut','nombre_1','apellido_1','apellido_2','departamento','correo','estado');
			
			$crud->display_as('nombre_1','Primer Nombre');
			$crud->display_as('nombre_2','Segundo Nombre');
			$crud->display_as('apellido_1','Apellido Paterno');
			$crud->display_as('apellido_2','Apellido Materno');

			//listados add
			$crud->field_type('departamento','enum',array('Facultad de Cs. de la Salud','Facultad de Cs. de la Educación','Facultad de Cs. de la Ingeniería','Facultad de Cs. Agrarias y Forestales','Facultad de Cs. Religiosas y Filosóficas','Facultad de Medicina','Facultad de Ciencias Básicas','Facultad de Ciencias Sociales y Económicas','Instituto de Estudios Generales'));
			$crud->field_type('estado','enum',array('Activo','Inactivo'));
			$crud->field_type('tipo','enum',array('Profesor','Administrador'));
			//avisos de norma

			$crud->callback_add_field('rut',function () {
				return '<input type="text" maxlength="50" value="" name="rut"> (Ej: 18.563.111-3 )';
			});


			$crud->unset_edit_fields('RUT');
			
			
			$output = $crud->render();

			$this->salida_datos($output);

		}
		//ADMINISTRA LAS PLANIFICACIONES Y ASIGNA LOS PROFESORES A LOS CURSOS
		public function admin_planificacion(){

			$crud = new grocery_CRUD();


			//$crud->set_theme('datatables');
			$crud->set_table('planificacion');
			$crud->set_language('spanish');
			$crud->set_subject('Planificacion');


			//para cuando quiero mostrar solo los ramos que tiene X profesor (X=rut del profesor logeado)
			//$crud->where('RUT_PROFESOR','18.657.111-9');
			
			$crud->columns('codigo_asignatura','rut_profesor','fecha_syllabus','syllabus');
			
			$crud->display_as('codigo_asignatura','Asignatura');
			$crud->display_as('rut_profesor','Profesor');
			$crud->display_as('fecha_syllabus','Fecha de actualizacion');
			$crud->set_field_upload('syllabus','assets/uploads/files');
			
			//relaciones con profes
			$crud->set_relation('rut_profesor','usuarios','rut');

			//relaciones con la asignatura
			$crud->set_relation('codigo_asignatura','asignatura','nombre');

			//restricciones
			//$crud->unset_add();
			//$crud->unset_edit();
			$crud->unset_add_fields('syllabus','fecha_syllabus');
			$output = $crud->render();

			$this->salida_datos_plani($output);

		}
		public function salida_datos_plani($output= null){
			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/admini_planificaciones.php',$output);
		}

		//ADMINISTRA A LOS CURSOS
		public function admin_asignatura(){

			$crud = new grocery_CRUD();


			//$crud->set_theme('datatables');
			$crud->set_table('asignatura');
			$crud->set_language('spanish');
			$crud->set_subject('Asignatura');

			$crud->columns('codigo','nombre');



			$output = $crud->render();

			$this->salida_datos_cursos($output);
		}
		public function salida_datos_cursos($output= null){
			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/admini_cursos.php',$output);
		}
		//ADMINISTRA A LOS USUARIOS (TODOS)
		public function admin_usuarios(){

			$crud = new grocery_CRUD();

			//$crud->set_theme('datatables');
			$crud->set_table('usuarios');
			$crud->set_language('spanish');
			$crud->set_subject('usuario');
			$crud->columns('rut','nombre_1','apellido_1','apellido_2','departamento','correo','tipo');


			//reglas
			$crud->field_type('estado','enum',array('Activo','Inactivo'));
			$crud->field_type('tipo','enum',array('Profesor','Administrador'));
			$crud->field_type('departamento','enum',array('Facultad de Cs. de la Salud','Facultad de Cs. de la Educación','Facultad de Cs. de la Ingeniería','Facultad de Cs. Agrarias y Forestales','Facultad de Cs. Religiosas y Filosóficas','Facultad de Medicina','Facultad de Ciencias Básicas','Facultad de Ciencias Sociales y Económicas','Instituto de Estudios Generales'));
			
			$crud->callback_add_field('rut',function () {
				return '<input type="text" maxlength="50" value="" name="rut"> (Ej: 18.563.111-3 )';
			});


			$crud->display_as('nombre_1','Primer Nombre');
			$crud->display_as('nombre_2','Segundo Nombre');
			$crud->display_as('apellido_1','Apellido Paterno');
			$crud->display_as('apellido_2','Apellido Materno');
		
			$output = $crud->render();

			$this->salida_datos_usuarios($output);


		}

		public function salida_datos_usuarios($output= null){

			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/admini_usuarios.php',$output);
		}
		  public function salir() {
	   		session_destroy();
	    	redirect('welcome');
		}

		public function planificaciones_historicas_ad(){

     	 $crud = new grocery_CRUD();

       
        $crud->set_language('spanish');
        $crud->set_subject('Planificacion');
        //$crud->set_theme('datatables');
        $crud->set_table('planificacion');
        $crud->where('codigo_asignatura','cod_asig');
      
      //condiciones
        $crud->display_as('codigo_asignatura','Asignatura');
        $crud->columns('codigo_asignatura','rut_profesor','fecha_syllabus','syllabus');

      $crud->set_field_upload('syllabus','assets/uploads/files');
        //relaciones con la asignatura
      $crud->set_relation('codigo_asignatura','asignatura','nombre');

      //restricciones
      $crud->unset_add();
      $crud->unset_delete();
      $crud->unset_edit();

      $output = $crud->render();

      $this->salida_datos_historicas_ad($output);

  		}

  		public function salida_datos_historicas_ad($output= null){

			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/planificaciones_historicas_ad.php',$output);
		}


		public function agregar_noticia()
{  

			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/agregar_noticia');

  if (isset($_POST["agregar_noticia"]))
  {
     //Guardamos valores para que no tenga que reescribirlos
  	//$this->load->view('agregar_noticia')
  	$titulo = $_POST['titulo'];
    $cuerpo = $_POST['cuerpo'];
    date_default_timezone_set("America/Santiago");
    $fecha = date ("Y-m-d");
    $hora= date("G:i:s");
    $nombreImagen="";
    $nombreFichero="";
    // Subir fichero
    $copiarFichero = false;
    $copiarImagen = false;

//AGREGAR IMAGEN
   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
   if (is_uploaded_file($_FILES['imagen'] ["tmp_name"]))
{

     $nombreDirectorio = "images_noticia/";
     $nombreImagen = $_FILES['imagen']['name'];
     $copiarImagen = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
     $nombreCompleto = $nombreDirectorio . $nombreImagen;
     if (is_file($nombreCompleto))
     {
      $idUnico = time();
      $nombreImagen = $idUnico . "-" . $nombreImagen;
    }
  }
  if ($copiarImagen){
    move_uploaded_file ($_FILES['imagen']['tmp_name'],
      $nombreDirectorio . $nombreImagen);
  }
  //AGREGAR ARCHIVO
     // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
  if (is_uploaded_file ($_FILES['archivo']['tmp_name']))
  {
   $nombreDirectorio = "images_noticia/";
   $nombreFichero = $_FILES['archivo']['name'];
   $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
   $nombreCompleto = $nombreDirectorio . $nombreFichero;
   if (is_file($nombreCompleto))
   {
    $idUnico = time();
    $nombreFichero = $idUnico . "-" . $nombreFichero;
  }
}
if ($copiarFichero){
  move_uploaded_file ($_FILES['archivo']['tmp_name'],
    $nombreDirectorio . $nombreFichero);
}
//pasar todos los valores a un array
$datos=array(
  'titulo' =>$titulo,
  'descripcion' =>$cuerpo,
  'fecha' =>$fecha,  
  'hora' =>$hora,
  'imagen' => $nombreImagen,
  'archivo' => $nombreFichero  
  );
  //insertar en la base de datos la noticia
if (($this->mod_usuarios->insertar_noticias($datos))) {
 $data['mensaje']=$result='<div class="alert alert-success"><h3>Noticia Ingresada Correctamente </h3></div>';

 

 
}else{

  
			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
  			$this->load->view('administrador/agregar_noticia');
}
}
}
		
		public function hist_plani(){
		    $cod_asig = $_GET['cod_asig'];
			$crud = new grocery_CRUD();

       
        $crud->set_language('spanish');
        $crud->set_subject('Planificacion');
        //$crud->set_theme('datatables');
        $crud->set_table('planificacion');
        $crud->where('codigo_asignatura',$cod_asig);
      
      //condiciones
        $crud->display_as('codigo_asignatura','Asignatura');
        $crud->columns('codigo_asignatura','rut_profesor','fecha_syllabus','syllabus');

      $crud->set_field_upload('syllabus','assets/uploads/files');
        //relaciones con la asignatura
      $crud->set_relation('codigo_asignatura','asignatura','nombre');

      //restricciones
      $crud->unset_add();
      $crud->unset_delete();
      $crud->unset_edit();

      $output = $crud->render();

      $this->salida_datos_historicas_ad($output);

			
		}

		public function malla(){

			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
  			$this->load->view('administrador/malla');
		}


		public function plantillas_ad(){

		$crud = new grocery_CRUD();

       
        $crud->set_language('spanish');
        $crud->set_subject('Plantilla');
        //$crud->set_theme('datatables');
        $crud->set_table('plantilla');

        $crud->columns('descripcion','plantilla');
        
        $crud->set_field_upload('plantilla','assets/uploads/files');

         $output = $crud->render();

      	$this->salida_datos_plantilla($output);

		}
  		
  		public function salida_datos_plantilla($output= null){

			$this->load->view('head_noticias');
			$this->load->view('headers/header_administrador');
			$this->load->view('administrador/plantillas.php',$output);
		}
  
		
	}
