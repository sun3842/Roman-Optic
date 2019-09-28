<style type="text/css" rel="stylesheet">
    body{
        background-image:url("./assets/images/login/logo_bd.png") ;
        background-repeat: no-repeat;
        background-size: cover;
        overflow-x: hidden;
        overflow-y: auto;
        min-height: 100vh;
    }
    .heading{
        font-weight: bold;
        text-align: center;
        color: white;
        font-style: oblique;
    }

    .login-box{
        position: relative;
        height: 100vh;
    }
    .login-panel{
        position: absolute;
        background-color: rgba(255,255,255,.2);
        /*opacity: .4;*/

        height: auto;
        width: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        z-index: 10000;
        padding: 1em;
        color: white;
    }
    .login-input{
        width: 500px;
        background: transparent;
        border-top: none;
        border-bottom: 2px solid white;
        border-left: none;
        border-right: none;
        outline: none;
        text-align: center;
        color: white;
    }
    a{
        color: white;!important;
        text-decoration: none;
    }
    .btn-common{
        color: white;
        border: none;
        background-color: #35C9A7;
        padding: 5px 5em 5px 5em;
        -webkit-box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
        box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
        cursor: pointer;
        outline: none;

    }
    .login-label{
        display: block;
        position: absolute;
        left: 37%;
        top: -5px;
        z-index: -1;
    }
    .login-input:focus ~ .login-label{
        top: -25px;
    }
    .login-label.active{
        top: -25px;
    }
    .heading-box{
        margin-top: 5%;
    }
    @media screen and (min-height: 240px) and (max-height: 640px){
        .heading-box{
            margin-top: 0;
        }
        .login-panel{
            /*top: 80%;*/
        }
        .welcome{
            visibility: hidden;
        }
    }

    @media screen and (min-width: 240px) and (max-width: 640px){
        .login-input{
            width: 240px;
        }
        .login-label{
            left: 18%;
        }

    }

</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php if (isset($title)) echo $title; else echo 'Whatsup | Optica'; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/app_assets/plugins/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css'); ?>">

<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo base_url('assets/app_assets/css/style.css') ?><!--">-->
    <!-- endinject -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/app_assets/plugins/bootstrap-4/css/bootstrap.css') ?>">

    <script rel="script" type="text/javascript"
            src="<?php echo base_url('assets/app_assets/plugins/jquery-3.3.1.min.js') ?>"></script>
    <script rel="script" type="text/javascript"
            src="<?php echo base_url('assets/app_assets/plugins/jquery-validation/jquery.validate.js') ?>"></script>
    <script rel="script" type="text/javascript"
            src="<?php echo base_url('assets/app_assets/plugins/jquery-validation/additional-methods.js') ?>"></script>
    <script rel="script" type="text/javascript"
            src="<?php echo base_url('assets/app_assets/plugins/bootstrap-4/js/bootstrap.js') ?>"></script>
</head>

<body>

<div class="row">
    <div class="col-12 login-box">
        <div class="row">
            <div class="col-12 heading-box">
                <h1 class="heading">Roman Optica</h1>
            </div>
        </div>
        <div class="login-panel">
            <h3 class="heading py-4 welcome" >Welcome</h3>

           <form  method="post">
            <div class="row py-4">
                <div class="col-12">
                    <input type="text" name="username" id="username" class="login-input">
                    <label class="login-label"><i class="far fa-envelope pl-4"></i> <span class="pr-4">Email Address</span></label>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-12">
                    <input type="password" name="password" id="password" class="login-input">
                    <label class="login-label"><i class="fas fa-unlock-alt pl-4"></i> <span class="pr-4">Password</span></label>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-12" style="text-align: center">
                    <a href="#" class="text-white">Forgot Password??</a>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-12" style="text-align: center">
                    <button type="submit" class="btn-common">Login</button>
                </div>
            </div>
           </form>
        </div>
    </div>
</div>

</body>

</html>
<script type="text/javascript" rel="script">
    $('.login-input').focusout(function () {
        if($(this).val()!=''){
            $(this).parent().find($('.login-label')).addClass('active');
        }
        else{
            $(this).parent().find($('.login-label')).removeClass('active');
        }
    });
</script>