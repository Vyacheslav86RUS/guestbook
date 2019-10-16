<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title><?php echo $this->title;?></title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../../css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--<script src="../../js/jquery-3.1.1.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="../../js/md5.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/main.js"></script>
    <!--<script sr="../../js/jquery.validate.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="../../js/tinymce/tinymce.min.js"></script>-->
  </head>
  <body>
<?php
    include 'menu.php';
    if(strpos($content_view, '.php')){
        include PATH_LAYOUTS.'/'.$content_view;
    } else {
        echo $content_view;
    }
    
?>
  </body>
</html>

