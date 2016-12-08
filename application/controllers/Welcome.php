<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	

	public function __construct()
  	{
    parent::__construct();
    session_start();
    $this->load->helper('url');
    $this->load->model('mod_usuarios');
    error_reporting(E_ERROR | E_PARSE);
        //$this->load->model('mod_usuarios');
  	}
	 public function index()
      {
    if($_SESSION['cuenta']['identificador']=='Administrador'){          
          redirect(base_url() .'index.php/administrador'); 
        }
    elseif ($_SESSION['cuenta']['identificador']=='Profesor') {
	       redirect(base_url() .'index.php/profesor'); 
	   }
     else{
        $this->login();
    }
    }  

    public function login()
  {
    //cargamos para hacer validacion

    
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('user', 'user', 'required');
    $this->form_validation->set_rules('pass', 'pass', 'required');

    $this->form_validation->set_message('required', '▲ este campo es obligatorio');

    

    if($this->form_validation->run()==FALSE){
      $this->load->view('login');
    }
    else{
      $user = set_value("user");
      $pass = set_value("pass");

      
            //consultar si existe el usuario en la base de datos
      $res = $this->mod_usuarios->buscar_usuario($user, $pass);
      if(!$res){
            //usuario no existe
        $this->load->view('login',array('men'=>'usuario no registrado'));
      }
      else{
        $_SESSION['cuenta']['user']=$user;
        $_SESSION['cuenta']['pass']=$pass;

            //preguntar que tipo de usuario es si es Profesor o Administrador
        $res2 = $this->mod_usuarios->tipo_usuario($user);

        foreach ($res2->result() as $atributo) {
          $tipo=$atributo->tipo;
          $nombre_1=$atributo->nombre_1;
          $nombre_2=$atributo->nombre_2;
          $apellido_1=$atributo->apellido_1;
          $apellido_2=$atributo->apellido_2;
      }  

      
        if($tipo=="Administrador"){
            $_SESSION['cuenta']['identificador']='Administrador';
             $_SESSION['cuenta']['nombre_1']=$nombre_1;
             $_SESSION['cuenta']['nombre_2']=$nombre_2;
             $_SESSION['apellido_1']['nombre_1']=$apellido_1;
             $_SESSION['cuenta']['apellido_2']=$apellido_2;

              redirect(base_url() .'index.php/administrador'); 
              }
            else{
              $consulta= $this->mod_usuarios->extraer_estado_prof($user);
              
              if(($tipo=="Profesor" && $consulta==TRUE) ){

                 $_SESSION['cuenta']['nombre_1']=$nombre_1;
                 $_SESSION['cuenta']['nombre_2']=$nombre_2;
                 $_SESSION['cuenta']['apellido_1']=$apellido_1;
                 $_SESSION['cuenta']['apellido_2']=$apellido_2;

                $_SESSION['cuenta']['identificador']='Profesor';
                		redirect(base_url() .'index.php/profesor'); 
              }
              else{

                $this->load->view('login',array('men'=>'el usuario no esta registrado'));
              }
            }

          }
        }
      } 
}
