<div id="mobileTest">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=899px, initial-scale=0"> -->
        <meta charset="utf-8">
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
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title> Mylatindate </title>
        <link rel="shorcut icon" href="<?php echo base_url('img/src/favicon.png'); ?>" type="image/png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?php echo base_url('css/master.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/menu-styles.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/index-styles-mobile.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/lib/control/iconselect.css'); ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/js.cookie.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/lib/control/iconselect.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/lib/iscroll.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    </head>

    <header class="hero-image">
        <div class="form-container">
            <form class="form-register pd-tp-15 my-4" action="<?php echo base_url('Home/user_register'); ?>" method="post">
                <div class="inputs-container">
                    <nav>
                        <div class="center-to-parent">
                            <p class="text-white">¿<?= lang("already") ?>?</p>
                            <a href="<?php echo base_url('Home/Login'); ?>"
                                class="no-decoration text-uppercase login my-icon-select-mobile"><?= lang("login") ?></a>

                            <div style="padding: 0px 15px" id="my-icon-select-mobile"></div>
                            <div style="padding: 0px 30px"></div>
                        </div>
                    </nav>
                    <img src="<?php echo base_url('img/src/logo.png'); ?>" width="300px" alt="Logo Mylatindate">
                    <p class="text-white text-uppercase form-title pd-t-2"><?= lang("free_join") ?></p>
                    <div class="pd-lr-25">
                        <hr>
                        <?php if (!empty($exists_user)) { echo $exists_user; } ?>
                        <input type="text" class="margin-for-rows input-text" name="txt-username"
                            placeholder="<?= lang("first_name") ?>" required>
                        <div class="margin-for-rows gender-container">
                            <div class="center-to-parent">
                                <p class="text-white"><?= lang("iam") ?></p>
                            </div>
                            <div class="center-to-parent">
                                <input type="radio" name="txt-gender" value="1" checked><img
                                    src="<?php echo base_url('img/src/icon_man.png'); ?>" alt="man-png">
                                <input type="radio" name="txt-gender" value="2"><img
                                    src="<?php echo base_url('img/src/icon_woman.png'); ?>" alt="woman.png">
                            </div>
                        </div>
                        <input type="email" class="margin-for-rows input-text" name="txt-email"
                            placeholder="<?= lang("your_email") ?>" required>
                        <input type="password" class="margin-for-rows input-text" name="txt-password"
                            placeholder="<?= lang("your_password") ?>" required>
                        <input type="submit" class="margin-for-rows cursor-pointer text-uppercase submit bg-primary"
                            name="submit_register" value="<?= lang("get_started_now") ?>!">
                    </div>
                </div>
            </form>
        </div>
        <div class="footer">
            <div class="center-to-parent">
                <p class="text-white p-title" style="text-shadow: 5px 5px 10px #000000;">
                    <?= lang("have_the_perfect_date") ?>
                </p>
            </div>
        </div>
    </header>


    <div class="side-banner side-banner--left"></div>
    <div class="side-banner side-banner--right"></div>
    <section class="second-section pd-t-20">
        <h2 class="margin-for-sections text-center text-capitalize text-primary mg-0 ">
            <?= lang("international_latin_dating") ?></h2>
        <div class="margin-for-sections info-container mg-0">
            <div class="info">
                <p>
                    <?= lang("text_international_latin_dating") ?>
                </p>
            </div>
            <div class="img">
                <img class="w-340" src="<?php echo base_url('img/backgrounds/dinner.png'); ?>" alt="dinner.png">
            </div>
        </div>
    </section>

    <section class="second-section">
        <div class="latin-single">
            <div class="center-to-parent">
                <p class="text-white p-title text-center">
                    <span class="text-bold text-white text-center"><?= lang("latin_singles") ?></span>
                </p>
            </div>
        </div>
        <div class="margin-for-sections info-container bg-latin-single mg-0">
            <div class="info info-single">
                <p>
                    <?= lang("text_latin_singles") ?>
                </p>
            </div>
            <div class="margin-for-sections icons-container mg-tb-20">
                <div class="center-to-parent pd-lr-17">
                    <img class="img-latin-single w-100" src="<?php echo base_url('img/src/build.png'); ?>"
                        alt="icon.png">
                </div>
                <div class="center-to-parent pd-lr-17">
                    <img class="img-latin-single w-100" src="<?php echo base_url('img/src/travel.png'); ?>"
                        alt="icon.png">
                </div>
                <div class="center-to-parent pd-lr-17">
                    <img class="img-latin-single w-65" src="<?php echo base_url('img/src/bag.png'); ?>" alt="icon.png">
                </div>
            </div>
        </div>
    </section>

    <section class="margin-for-sections background-primary mg-0">
        <h2 class="text-center text-capitalize text-white fsize-50"><?= lang("how_it_works") ?></h2>
        <div class="margin-for-sections icons-container">
            <div class="center-to-parent">
                <img src="<?php echo base_url('img/src/ic_computer.png'); ?>" alt="icon.png">
            </div>
            <div class="center-to-parent">
                <img src="<?php echo base_url('img/src/ic_search.png'); ?>" alt="icon.png">
            </div>
            <div class="center-to-parent">
                <img src="<?php echo base_url('img/src/ic_chat.png'); ?>" alt="icon.png">
            </div>
        </div>
        <div class="margin-for-sections icons-description-container">
            <div class="description-container">
                <p class="text-center text-bold text-white title">
                    <?= lang("create_a_profile") ?>
                </p>
                <div class="description">
                    <p class="text-center text-white">
                        <?= lang("create_personalised_profile") ?>
                    </p>
                </div>
            </div>
            <div class="description-container">
                <p class="text-center text-bold text-white title">
                    <?= lang("browse_photos") ?>
                </p>
                <div class="description">
                    <p class="text-center text-white">
                        <?= lang("search_member") ?>
                    </p>
                </div>
            </div>
            <div class="description-container">
                <p class="text-center text-bold text-white title">
                    <?= lang("start_communicating") ?>
                </p>
                <div class="description">
                    <p class="text-center text-white">
                        <?= lang("show_interest") ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="margin-for-sections center-to-parent">
            <button type="button" class="text-uppercase btn-find-match cursor-pointer"
                name="button"><?= lang("find_match") ?></button>
        </div>
    </section>

    <section class="margin-for-sections background-simple mg-0 pd-tp-20 bg-start-success">
        <h2 class="text-center text-capitalize"><?= lang("start_success") ?></h2>
        <div class="margin-for-rows center-to-parent">
            <img src="<?php echo base_url('img/src/logo_black.png'); ?>" alt="logo.png">
        </div>
        <hr class="margin-for-rows">
        <div class="margin-for-sections icons-container">
            <div class="center-to-parent">
                <img src="<?php echo base_url('img/src/ic_protection.png'); ?>" alt="icon.png">
            </div>
            <div class="center-to-parent">
                <img src="<?php echo base_url('img/src/ic_verification.png'); ?>" alt="icon.png">
            </div>
            <div class="center-to-parent">
                <img src="<?php echo base_url('img/src/ic_atention.png'); ?>" alt="icon.png">
            </div>
        </div>
        <div class="margin-for-sections icons-description-container">
            <div class="description-container">
                <p class="text-left text-bold text-blue title margin">
                    <?= lang("protection") ?>
                </p>
                <div class="description">
                    <p class="text-left">
                        <?= lang("text_protection") ?>
                    </p>
                </div>
            </div>
            <div class="description-container">
                <p class="text-left text-bold text-blue title margin">
                    <?= lang("verification") ?>
                </p>
                <div class="description">
                    <p class="text-left">
                        <?= lang("text_verification") ?>
                    </p>
                </div>
            </div>
            <div class="description-container">
                <p class="text-left text-bold text-blue title margin">
                    <?= lang("attention") ?>
                </p>
                <div class="description">
                    <p class="text-left">
                        <?= lang("text_attention") ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- HACER RECLAMO -->
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col col-12">
                    <a href=<?php echo base_url("complaintspolicy") ?>><strong style="color: white;"><button class="p-3" style="background-color: #1367B0; border-radius: 1rem; border-width: 0; color: white;" type="button"><?= lang('complaints_policy'); ?><strong></button><a>
                </div>
            </div>
        </div>
        
        
    </section>

</div>

<div id="desktopTest">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta charset="utf-8">
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
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title> Mylatindate </title>
        <link rel="shorcut icon" href="<?php echo base_url('img/src/favicon.png'); ?>" type="image/png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?php echo base_url('css/master.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/menu-styles.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/index-styles.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/lib/control/iconselect.css'); ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/js.cookie.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/lib/control/iconselect.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/lib/iscroll.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        
        
    </head>

    <header class="header-index d-flex flex-column justify-content-between">

        <form class="form-register p-2 py-5 mx-2 mx-sm-4 mt-4"
            action="<?php echo base_url('Home/user_register'); ?>" method="post">
            <div class="px-2">
                <nav>
                    <div class="d-flex justify-content-end">
                        <a href="<?php echo base_url('Home/Login'); ?>"
                            class="no-decoration text-uppercase login my-icon-select"><?= lang("login") ?></a>
                        <div style="padding: 0px 15px" id="my-icon-select"></div>
                        <div style="padding: 0px 30px"></div>
                    </div>

                </nav>
                <img src="<?php echo base_url('img/src/logo.png'); ?>" class="m-auto" width="80%"
                    alt="Logo Mylatindate">
                <div class="px-2 px-lg-4 mt-3">
                    <?php if (!empty($exists_user)) { echo $exists_user; } ?>
                    <input type="text" class="margin-for-rows input-text form-control py-2" name="txt-username"
                        placeholder="<?= lang("first_name") ?>" required autocomplete="off">
                    <div class="d-flex justify-content-around align-items-center my-3">
                        <p class="text-white my-auto"><?= lang("iam") ?></p>
                        <div class="center-to-parent">
                            <div>
                                <input type="radio" name="txt-gender" value="1" checked>
                                <img src="<?php echo base_url('img/src/icon_man.png'); ?>" alt="man-png">
                            </div>
                            <div class="ml-3">
                                <input type="radio" name="txt-gender" value="2">
                                <img src="<?php echo base_url('img/src/icon_woman.png'); ?>" alt="woman.png">
                            </div>
                        </div>
                    </div>
                    <input type="email" class="margin-for-rows input-text form-control w-100 py-2" autocomplete="off"
                        name="txt-email" placeholder="<?= lang("your_email") ?>" required>
                    <input type="password" class="margin-for-rows input-text form-control py-2 mt-3" name="txt-password"
                        placeholder="<?= lang("your_password") ?>" required autocomplete="off">
                    <input type="submit" class="margin-for-rows cursor-pointer text-uppercase submit bg-primary mt-4"
                        name="submit_register" value="<?= lang("get_started_now") ?>!">
                </div>
            </div>
        </form>
        <section class="banner-pink p-3 text-center mt-4">
            <p class="text-white perfect-title p-title">
                <?= lang("have_the_perfect_date") ?>
            </p>
        </section>

    </header>

    <div class="container-fluid">
        <section class="section-black bg-black row">
            <div class="col-md-12 col-lg-4 p-2 py-5 py-md-4 p-md-4">
                <h6 class="text-eee font-weight-bold mb-3"> <?= lang('why_choose_mylatindate'); ?> </h6>
                <small class="text-eee"> <?= lang('content_why_choose_mylatindate'); ?> </small>
            </div>
            <div class="col-md-12 col-lg-4 p-2 py-5 py-md-4 p-md-4">
                <h6 class="text-eee font-weight-bold mb-3"> <?= lang('connecting_singles_worldwide'); ?> </h6>
                <small class="text-eee"> <?= lang('content_connecting_singles_worldwide'); ?> </small>
            </div>
            <div class="col-md-12 col-lg-4 p-2 py-5 py-md-4 p-md-4">
                <h6 class="text-eee font-weight-bold mb-3"> <?= lang('start_writing'); ?> </h6>
                <small class="text-eee"> <?= lang('content_start_writing'); ?> </small>
            </div>

        </section>
    </div>

    <section class="section-blue-gradient p-3 px-2 px-md-4">
        <h2 class="text-white text-center font-weight-bold"> <?= lang('the_latin_singles_trip') ?> </h2>
    </section>

    <section class="images-text bg-black">
        <div class="d-flex flex-column flex-md-row">

            <div class="p-2 py-5 py-md-4 p-md-4">
                <small class="text-eee"> <?= lang('two_fully_catered'); ?> <span
                        class="text-primary"> <?= lang('unlimited_personal_text'); ?></small>
            </div>

            <div class="d-flex">
                <div class="">
                    <img src="<?php echo base_url('img/backgrounds/images_new/desktop-03.jpg'); ?>" class="img-fluid"
                        width="600px">
                </div>
                <div class="">
                    <img src="<?php echo base_url('img/backgrounds/images_new/desktop-04.jpg'); ?>" class="img-fluid"
                        width="600px">
                </div>
            </div>

        </div>

        <div class="d-flex flex-column flex-md-row">
            <div class="d-flex flex-column flex-md-row">
                <div class="">
                    <img src="<?php echo base_url('img/backgrounds/images_new/desktop-05.jpg'); ?>" class="img-fluid"
                        width="100%">
                </div>
                <div class="">
                    <img src="<?php echo base_url('img/backgrounds/images_new/desktop-06.jpg'); ?>" class="img-fluid"
                        width="100%">
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row">
                <div class="">
                    <img src="<?php echo base_url('img/backgrounds/images_new/desktop-07.jpg'); ?>" class="img-fluid"
                        width="100%">
                </div>
                <div class="">
                    <img src="<?php echo base_url('img/backgrounds/images_new/desktop-08.jpg'); ?>" class="img-fluid"
                        width="100%">
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black d-flex flex-column " style="padding: 0; background: #000;">
        <h2 class="text-eee font-weight-bold py-3 text-center"> <?= lang('start_your_success'); ?> </h2>
        <img src="<?php echo base_url('img/src/logo.png'); ?>" class="m-auto logo-footer img-fluid px-5"
            style="max-width: 400px;" alt="Logo Mylatindate">

            <!-- HACER RECLAMO -->
            <div class="row text-center mt-3">
                <div class="col col-12">
                    <a href=<?php echo base_url("complaintspolicy") ?>><strong style="color: white;"><button class="p-3" style="background-color: #1367B0; border-radius: 1rem; border-width: 0; color: white;" type="button"><?= lang('complaints_policy'); ?><strong></button><a>
                </div>
            </div>
            
        
        <section class="banner-pink p-3 text-center mt-4">
            <p class="text-white perfect-title p-title">
                <?= lang("have_the_perfect_date") ?>
            </p>
        </section>
    </footer>
</div>