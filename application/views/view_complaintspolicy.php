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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
  
  <style>
      #complaintspolicy{
          border-style: solid;
          border-color: #8BD9FF;
          border-width: 0.3rem;
          border-radius: 0.8rem;
          margin: 0 auto;
      }
      #inputform{
        border-radius: 0; 
        border-width: 0 0 0.2rem 0; 
        border-color: #5EBBE8;   
      }
  </style>

</head>

<body>
 <div class="container bg-transparent">
    <div class="col col-10 col-lg-6 bg-white" id="complaintspolicy">
        <h2 class="text-center m-3" ><strong style="color: #5EBBE8"><?= lang('complaints_policy');?></strong></h2>
        <p class="text-center mb-3"><?= lang('complaints_policy_description') ?></p>
        <p class="text-center mb-3"><?= lang('reporting_complaints') ?></p>
        <form method="POST" action="#">
            <input type="text" class="form-control mb-3" name="name" placeholder="Name" id="inputform">
            <input type="text" class="form-control mb-3" name="email" placeholder="Email" id="inputform">
            <input type="text" class="form-control mb-3" name="url" placeholder="Url" id="inputform">
            <input type="text" class="form-control mb-3" name="complaint" placeholder="Complaint" id="inputform">
            <?php if(isset($isValid)) {?>
                <?php if($isValid == false) {?>
                    <div class="alert alert-danger" role="alert">
                        <strong>All fields must be complete and the email must be valid.</strong>
                    </div>
                <?php }else{?>
                    <div class="alert alert-success" role="alert">
                        <strong>Your message has been sent successfully.</strong>
                    </div>
                <?php }?>
            <?php }?>
            <div class="row mb-3">
                <div class="col col-12 text-center">
                    <button class="btn rounded-pill" style="background-color: #5EBBE8 "><strong class="m-5" style="font-size: 2rem; color: white;"><?= lang("complaints_policy_button")?></strong></button>
                </div>
            </div>
        <form>
    </div>
 </div>
 
</body>

</html>
