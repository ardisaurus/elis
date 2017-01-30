<?php  
  
  if (isset($_GET['action'])){
    $action=$_GET['action'];
  } else{
    $action="login";
  }
  switch ($action) {
    case 'daftar':
      $page="daftar.php";
      break;

    case 'logout':
      session_start();
      unset($_SESSION['member']);
      session_destroy();
      $page="login.php";
    break;
    
    default:
      $page="login.php";
      break;
  }

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELIS : E-Labs Inventory Sistem</title>
    <!-- Bootstrap core CSS -->
	  <link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="assets/css/sticky-footer.css">
    <link rel="stylesheet" href="assets/css/costum.css">    
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" media="screen">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <style type="text/css">
    body {
      padding-top: 70px;
      background: url("assets/img/bglogin.png") no-repeat center center fixed;
      background-size:100% auto;
    }
    </style>       
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
    <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-bookmark"></i> ELIS</a>   
    </div>
  </nav>
    
    <div class="container">
    <?php Include $page; ?>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">NAS &copy; 2015</p>            
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- jQuery Version 1.11.0 -->
    <script src="assets/js/jquery.js"></script>    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/alert.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="assets/js/locales/bootstrap-datetimepicker.id.js"charset="UTF-8"></script>

    <!-- Fungsi datepickier yang digunakan -->
    <script type="text/javascript">
      $('.input-group.date').datetimepicker({
              language:  'id',
              weekStart: 1,
              autoclose: 1,
              todayHighlight: 1,
              startView: 4,
              minView: 2,
              forceParse: 0
      });
    </script>

</body>
</html>