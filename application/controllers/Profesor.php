<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    session_start();
    $this->load->helper('url');
    $this->load->model('mod_usuarios');
    $this->load->library('grocery_CRUD');
    error_reporting(E_ERROR | E_PARSE);
        //$this->load->model('mod_usuarios');
  }

  public function index(){
	  $this->load->view('head_noticias');
	  $this->load->view('headers/header_profesor');
	  $this->load->view('profesor/noticias');
	}

  public function cursos_profesor()
      {

        $crud = new grocery_CRUD();

       
        $crud->set_language('spanish');
        $crud->set_subject('Planificacion');
        //$crud->set_theme('datatables');
        $crud->set_table('planificacion');
        $rut=$_SESSION['cuenta']['user'];
        $crud->where('rut',$rut);
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
      $crud->unset_add();
      $crud->unset_delete();
      $crud->edit_fields('fecha_syllabus','syllabus');

            
      $output = $crud->render();

      $this->salida_datos($output);

      }

  public function planificaciones_historicas(){

      $crud = new grocery_CRUD();

       
        $crud->set_language('spanish');
        $crud->set_subject('Planificacion');
       // $crud->set_theme('datatables');
        $crud->set_table('planificacion');
      
      
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

      $this->salida_datos_historicas($output);

  }

  public function salida_datos_historicas($output=null){

      $this->load->view('head');
      $this->load->view('headers/header_profesor');
      $this->load->view('profesor/planificaciones_historicas.php',$output);

  }

  public function salida_datos($output= null){

      $this->load->view('head');
      $this->load->view('headers/header_profesor');
      $this->load->view('profesor/cursos_profesor.php',$output);
    }

  public function salir() {
    session_destroy();
    redirect('welcome');
  }

  public function plantillas_pr(){

    $crud = new grocery_CRUD();

       
        $crud->set_language('spanish');
        $crud->set_subject('Plantilla');
        //$crud->set_theme('datatables');
        $crud->set_table('plantilla');

        $crud->columns('descripcion','plantilla');
        
        $crud->set_field_upload('plantilla','assets/uploads/files');

        //restricciones
        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_edit();


         $output = $crud->render();

        $this->salida_datos_plantilla($output);

    }
      
      public function salida_datos_plantilla($output= null){

      $this->load->view('head_noticias');
      $this->load->view('headers/header_profesor');
      $this->load->view('profesor/plantillas.php',$output);
    }

}

