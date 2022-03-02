<?php $general_settings = $this->model_admin->settings(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="description" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['description_app'])) ?>">
  <meta property="og:site_name" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta property="og:title" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta property="og:description" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['description_app'])) ?>">
  <meta name="language" content="es">
  <meta name="keywords" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= base_url() ?>">
  <meta property="og:image" content="<?= base_url('img/settings/'.$general_settings[0]['favicon_app']) ?>">
  <meta property="og:image:width" content="96">
  <meta property="og:image:height" content="96">
  <meta property="author" content="Juan Camilo Bolivar Ramirez">
  <meta name="copyright" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <link rel="icon" type="image/png" href="<?= base_url('img/settings/'.$general_settings[0]['favicon_app']) ?>">

  <title>Dashboard - <?= $general_settings[0]['name_app'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('plugins/jqvmap/jqvmap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('plugins/summernote/summernote-bs4.min.css') ?>">

  <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/chat-stylesheet.css?v='.rand()) ?>">

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url('js/chat-scriptsheet.js?v='.rand()) ?>"></script>
  <script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">