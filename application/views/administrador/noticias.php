
<!--aqui empieza-->


            <!-- Brand and toggle get grouped for better mobile display -->
                        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="<?php echo base_url();?>index.php/administrador"><i class="fa fa-fw fa-file"></i> Noticias</a>
                    </li>
                    <li class ="" >
                        <a href="<?php echo base_url();?>index.php/administrador/admin_profesor"><i class="glyphicon glyphicon-th-list"></i> Profesores</a>
                    </li>
                    <li class >
                        <a href="<?php echo base_url();?>index.php/administrador/admin_usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a>
                    </li>
                    <li class >
                        <a href="<?php echo base_url();?>index.php/administrador/admin_asignatura"><i class="glyphicon glyphicon-paperclip"></i> Cursos</a>
                    </li>
                    <li class >
                        <a href="<?php echo base_url();?>index.php/administrador/admin_planificacion"><i class="glyphicon glyphicon-time"></i> Planificaciones</a>
                    </li>
                    <li class>
                        <a href='<?php echo base_url();?>index.php/administrador/malla'><i class="glyphicon glyphicon-time"></i>Planificaciones historicas</a>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url();?>index.php/administrador/agregar_noticia"><i class="glyphicon glyphicon-plus"></i> Agregar Noticia</a>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url();?>index.php/administrador/plantillas_ad"><i class="glyphicon glyphicon-plus"></i>Administrar Plantillas</a>
                    </li>        
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <!---start-content-->
  <?php// echo form_open_multipart(site_url().'/control/subir_archivo?array3='.$rut.'&array2='.$CODIGO_ASIGNATURA.'&array='.$NOMBRE_1);?>
  <div class="content" id="formulario4">
    <div class="row">
      <h2 align="center"><span class="glyphicon glyphicon-book"></span> Noticias de la Carrera de Auditoria</h2> 
      <div class="wrap">
        <?php  
                echo $mensaje;//imprimir si mensaje de borrado existoso o no
                    // Enviar consulta
                $consulta =$this->mod_usuarios->ver_noticias();
             // Mostrar resultados de la consulta
                $nfilas = mysql_num_rows ($consulta);
                if ($nfilas > 0)
                {

                 for ($i=0; $i<$nfilas; $i++)
                 {

                  $resultado = mysql_fetch_array ($consulta);
                  
                  echo "<div class='service_list' id='". $resultado['noticia_id'] ."' data='". $resultado['noticia_id'] ."'>";
                  if(($resultado['archivo']!="")){
                    echo '<li><a target="_blank" href="'.base_url().'images_noticia/'.$resultado['archivo'] .'">'.$resultado['archivo'] .'</a></li>';        
                  }
                  if(($resultado['imagen']!="")){
                   echo "<a href='".base_url().'images_noticia/'.$resultado['imagen'] ."' class='product_img_link' target='_blank' title='". $resultado['imagen'] ."'> <img width='129' height='129' src='".base_url().'images_noticia/'.$resultado['imagen'] ."'></a>";
                   
                 }

                    echo '<p class="info_general">Publicado: '. $resultado['fecha'] .'</p> ';//fecha
                    echo '<h3><a '. $resultado['titulo'].'</a></h3>';//titulo
                     echo '<p class="product_desc">' . $resultado['descripcion'] . '<br></p>';//descripcion(cuerpo)
                    echo "<div align='right'>";//aliniamos boton a la derecha de la pantalla
                    echo"</div>";
                    echo"</div>";
                  }
                }
                //si no hay noticias mostramos el mensaje
                else{
                  print '<div class="no_noticia">No hay noticias disponibles... </div>';
                  echo "</div>";
                }
                ?>
                
              </div>


              <!---termino de submenu-->
              <?//php echo form_close();?>
              
            </div>  
          </div>       

          <!---End-content-->
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

</body>


