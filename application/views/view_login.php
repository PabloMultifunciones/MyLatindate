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

  <title>Hime <?= lang("login") ?> - Mylatindate</title>

  <link rel="shorcut icon" href="<?php echo base_url('img/src/favicon.png'); ?>" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
  <link rel="stylesheet" href="<?php echo base_url('css/master.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('css/login-styles.css'); ?>">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '2351089331858923',
        cookie     : true,                     
        xfbml      : true,                     
        version    : 'v7.0'           
      });
    };

    (function(d, s, id) {                      
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function checkLoginState() {               
      FB.getLoginStatus(function(response) {   
        statusChangeCallback(response);
      });
    }

    function statusChangeCallback(response) {                  
      if (response.status === 'connected') {  
        connectToFacebook(response.authResponse.accessToken);  
      }
    }

    function connectToFacebook(accessToken) {

      FB.api('/me', function(response) {

        var facebook_account_id = response.id;

        $.ajax({
          url      : '<?= base_url('home/login_facebook/') ?>',
          data     : { facebook_account_id:facebook_account_id, accessToken:accessToken },
          type     : 'POST',
          success  : function(resp) {
            
            if (resp.trim() == "connect_ok_for_"+facebook_account_id) {
              location.reload();
            }
          }
        })
      });
    }
  </script>

</head>

<body>
  <header>
    <div class="logo-container">
      <a href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('img/src/logo.png'); ?>" alt="logo.png">
      </a>
    </div>
    <div class="form-error"><?php if (!empty($noexists_user)) { echo $noexists_user; } ?></div>
    <div class="form-container">
      <form class="form-login" action="<?php echo base_url('Home/user_login'); ?>" method="post">
        <div class="inputs-container">
          <input type="email" class="input-text" name="txt-email" placeholder="<?= lang("your_email") ?>" required>
          <input type="password" class="margin-for-rows input-text" name="txt-password" placeholder="<?= lang("your_password") ?>" required>
          <div class="margin-for-rows checkbox-container">
            <label class="cursor-pointer" for="checkbox_keepLogIn">
              <span class="text-white"><?= lang("keeepme") ?></span>
              <input type="checkbox" id="checkbox_keepLogIn" name="" value=""><span class="check"></span>
            </label>
          </div>
         <input type="submit" class="margin-for-rows cursor-pointer submit bg-primary" style="background: #007bff;" name="submit_login" value="<?= lang("login") ?>">
          <div class="margin-for-rows form-divider">
            <div class="hr-container">
              <hr>
            </div>
            <div>
              <p class="text-uppercase text-white hr-divisor"><?= lang("or") ?></p>
            </div>
            <div class="hr-container">
              <hr>
            </div>
          </div>
          <a href="<?php echo base_url('Home/ForgotPass'); ?>" class="margin-for-rows no-decoration text-white text-center"><?= lang("forgot") ?></a>
          <a href="<?php echo base_url(); ?>" class="margin-for-rows no-decoration text-white text-center"><?= lang("join_free") ?></a>
        </div>
      </form>
    </div>
  </header>

  <!-- REVIEW:  Modificar los enlaces o añadir los que falten-->
  <!-- <script type="text/javascript" src="<?php echo base_url('js/jquery-1.9.1.js'); ?>"></script> -->

</body>

</html>
