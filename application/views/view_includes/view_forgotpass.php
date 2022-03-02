<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <meta name="description" content="Have the perfect date and find your latin love">

  <meta property="og:site_name" content="My Latin Date">
  <meta property="og:title" content="My Latin Date">
  <meta property="og:description" content="Have the perfect date and find your latin love">
  <meta name="language" content="en">
  <meta name="keywords" content="my, latin, date, have, perfect, date, find, latin, love">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.mylatindate.com">
  <meta property="og:image" content="https://www.mylatindate.com/img/src/favicon.png">
  <meta property="og:image:width" content="96">
  <meta property="og:image:height" content="96">
  <meta property="author" content="Duduar Coder">
  <meta name="copyright" content="My Latin Media" />
  <meta name="theme-color" content="#EC287E" />

  <link rel="shorcut icon" href="<?php echo base_url('img/src/favicon.png'); ?>" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
  <link rel="stylesheet" href="<?php echo base_url('css/master.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('css/login-styles.css'); ?>">

  <title><?= lang("reset_pass") ?> - Mylatindate</title>

</head>

<body>
  <header>
    <br>
    <br>
    <br>
    <br>
    <div class="logo-container">
      <a href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('img/src/logo.png'); ?>" alt="logo.png">
      </a>
    </div>
    <br>
    <p class="text-white text-center fsize-24"><?= lang("reset_you_pass") ?></p>
    <div class="form-error"><?php if (!empty($message_response)) { echo $message_response; } ?></div>
    <?php if (!empty($view_step) && $view_step == "required_email") { ?>

      <div class="form-container">
        <form class="form-login" action="<?php echo base_url('Home/ForgotPass/Validate-Email'); ?>" method="post">
          <div class="inputs-container">
            <input type="text" class="input-text" name="txt-email" placeholder="<?= lang("enter_email") ?>" required>
            <input type="submit" class="margin-for-rows cursor-pointer submit" name="submit_login" value="<?= lang("reset_pass") ?>">
            <a href="<?php echo base_url('Home/Login'); ?>" class="margin-for-rows no-decoration text-white text-center"><?= lang("back_login") ?></a>
          </div>
        </form>
      </div>
    <?php } else if (!empty($view_step) && $view_step == "required_code") { ?>

      <div class="form-container">
        <form class="form-login" action="<?php echo base_url('Home/ForgotPass/Validate-Code'); ?>" method="post">
          <div class="inputs-container">
            <input type="text" class="input-text" name="txt-code" placeholder="<?= lang("enter_code") ?>" required>
            <input type="hidden" class="input-text" name="txt-id" value="<?php echo $id_user; ?>">
            <input type="submit" class="margin-for-rows cursor-pointer submit" name="submit_login" value="<?= lang("reset_pass") ?>">
            <a href="<?php echo base_url('Home/Login'); ?>" class="margin-for-rows no-decoration text-white text-center"><?= lang("back_login") ?></a>
          </div>
        </form>
      </div>
    <?php } else if (!empty($view_step) && $view_step == "required_pass") { ?>

      <div class="form-container">
        <form class="form-login" action="<?php echo base_url('Home/ForgotPass/Validate-Pass'); ?>" method="post">
          <div class="inputs-container">
            <input type="password" class="input-text" name="txt-pass" placeholder="<?= lang("enter_you_pass") ?>" required><br>
            <input type="password" class="input-text" name="txt-repass" placeholder="<?= lang("reenter_you_pass") ?>" required>
            <input type="hidden" class="input-text" name="txt-id" value="<?php echo $id_user; ?>">
            <input type="submit" class="margin-for-rows cursor-pointer submit" name="submit_login" value="<?= lang("reset_pass") ?>">
            <a href="<?php echo base_url('Home/Login'); ?>" class="margin-for-rows no-decoration text-white text-center"><?= lang("back_login") ?></a>
          </div>
        </form>
      </div>
    <?php } ?>
  </header>

  <!-- REVIEW:  Modificar los enlaces o añadir los que falten-->
  <!-- <script type="text/javascript" src="<?php echo base_url('js/jquery-1.9.1.js'); ?>"></script> -->

</body>

</html>
