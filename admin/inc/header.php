<?php

    include_once '../lib/session.php';
    Session::checkSession();
    ob_start ();
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eu e-Canteen AdminPanel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tostr Css -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables CSS-->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Select2 Bootstrap  -->
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Select 2 Css -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Toster -->
  <script src="plugins/toastr/toastr.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">