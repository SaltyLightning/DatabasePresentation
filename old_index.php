<?php
/**
 * Created by PhpStorm.
 * User: xay
 * Date: 4/10/2018
 * Time: 7:12 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;
   charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Book Template</title>

    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <!-- Google fonts used in this theme  -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme CSS -->
    <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
    <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
    <![endif]-->
</head>
    <body class="main">
    <div class="background"></div>
    <div class="container content">
            <div class="col-md-10">  <!-- start main content column -->
                    <form action="submit.php" method="post">
                    Please enter your tag (format: Name-num):  <input type="text" name="name"><br>
                <input type="submit">
                </form>
            </div>
        </div>
    </body>
</html>
