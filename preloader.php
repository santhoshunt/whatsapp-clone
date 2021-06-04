<?php

include("config/db_connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whatsapp</title>
    <?php include('include_files.php'); ?>
    <style>
        body {
            height: 100%;
            width: 100%;
            background: #231e23;
        }

        .preloader {
            margin-top: 30vh;
        }

        .progress {
            margin-top: 10vh !important;
            /* position: fixed;
            width:70%; */
            background-color: darkslategrey;
        }


        .logo {
            margin-left: 50%;
            height: 100px;
            transform: translateX(-50%);
        }

        .brand-text {
            margin: 3vh 0;
        }

        .determinate {
            background-color: green !important;
        }
    </style>

    <script>
        $(document).ready(function() {

            var s = 0;

            function stopLoading(int) {
                clearInterval(int);
            }

            var load1 = setInterval(function() {
                $('.determinate').css("width", s + "%");
                s++;
                if (s >= 50) {
                    stopLoading(load1);
                }
            }, 20);

            var load2 = setInterval(function() {
                $('.determinate').css("width", s + "%");
                s++;
                if (s >= 75) {
                    stopLoading(load2);
                }
            }, 50);

            var load3 = setInterval(function() {
                $('.determinate').css("width", s + "%");
                s++;
                if (s >= 110) {
                    stopLoading(load3);
                }
            }, 75);
            setInterval(function() {
                window.location.replace("home.php");

            }, 3500);
        });
    </script>
</head>

<body>

    <div class="preloader">
        <div class="container">
            <div class="logo-container">
                <img class="logo" src="http://assets.stickpng.com/images/580b57fcd9996e24bc43c543.png" alt="">
            </div>
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
            <div class="brand-text white-text center"> WhatsApp <br> <i class="fas white-text fa-lock"></i> End-to-end encrypted </div>
        </div>
    </div>

</body>

</html>