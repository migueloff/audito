<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="">
                        <a href="<?php echo base_url();?>index.php/administrador"><i class="fa fa-fw fa-file"></i> Noticias</a>
                    </li>
                    <li class ="" >
                        <a href="<?php echo base_url();?>index.php/administrador/admin_profesor"><i class="glyphicon glyphicon-th-list"></i> Profesores</a>
                    </li>
                    <li class="active" >
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
                    <?php 
                        foreach($css_files as $file): ?>
                            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                        <?php endforeach; ?>
                        <?php foreach($js_files as $file): ?>
                            <script src="<?php echo $file; ?>"></script>
                        <?php endforeach; ?>

                            
                                <?php echo $output; ?>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!--<script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

</body>

</html>
