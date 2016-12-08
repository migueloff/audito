<!DOCTYPE HTML>
<html>
<head>
<title>Login - Planificacion Auditoria</title>
<meta charset="UTF-8" />
<meta name="Designer" content="PremiumPixels.com">
<meta name="Author" content="$hekh@r d-Ziner, CSSJUNTION.com">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>icon/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<script src="<?php echo base_url();?>archivos/rut/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>archivos/rut/jquery.Rut.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>archivos/rut/jquery.Rut.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>archivos/rut/sweetalert-dev.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" link href="<?php echo base_url();?>archivos/login/reset.css">
<link rel="stylesheet" type="text/css" link href="<?php echo base_url();?>archivos/login/structure.css">
<link rel="stylesheet" type="text/css" href = "<?php echo base_url()?>archivos/rut/sweetalert.css">

        <style type="text/css">      
          .divError{ 
              width: 300px;
              margin: 0 auto;
              height: 80px;
              text-align: center;
              border-radius: 33px 33px 33px 33px;
              -moz-border-radius: 33px 33px 33px 33px;
              -webkit-border-radius: 33px 33px 33px 33px;
              border: 0px solid #0f0e0f;
              background-color: #ed0909;
          } 
        </style>

        <script >
        //funcio para validar rut
            $(document).ready(function(){
              $('#user').Rut({
                  on_error: function(){sweetAlert("Error", "Porfavor, vuelva a ingresar un rut correcto", "error");$('#user').val('');},
                  format_on: 'keyup'
              });
              $("#divError").addClass("divError");
            });

        </script>       


</head>

<body>


<?php
echo form_open_multipart('Welcome/login');
?>  

<div class="box login" >

  <fieldset class="boxBody" >
    <div align="center" ><a class="ico"></a></div 
    <label>Usuario</label>
     <input placeholder="Ingrese aquí su rut" id="user" type="text" required class="form-control" name="user"/>
    
    <label>Contraseña</label>
    <input placeholder="Ingrese aquí su contraseña" type="password" required class="form-control" name="pass" id="pass" />
   <?php 
    if(isset($men)){
      echo '<br><label style="color:#f00">'.$men."</label>";
    }
   ?>
  </fieldset>
  <footer>
    <?php echo form_submit(array('value'=>'Login','class'=>'btnLogin')) ?>
  </footer>
</div>

<?php
echo form_close();
?>

</body>
</html>
