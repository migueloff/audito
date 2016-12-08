<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class>
                        <a href="<?php echo base_url();?>index.php/profesor"><i class="fa fa-fw fa-file"></i> Noticias</a>
                    </li>
                    <li class>
                        <a href="<?php echo base_url();?>index.php/profesor/cursos_profesor"><i class="fa fa-fw fa-bar-chart-o"></i> Planificaciones</a>
                    </li>
                    <li class = "">
                        <a href="<?php echo base_url();?>index.php/profesor/planificaciones_historicas"><i class="glyphicon glyphicon-time"></i> Planificaciones históricas</a>
                    </li>
                     <li class="active">
                        <a href="<?php echo base_url();?>index.php/profesor/plantillas_pr"><i class="glyphicon glyphicon-plus"></i>Plantillas</a>
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
