<?php

include('config/db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp</title>
    <?php include('cdns.php'); ?>
    <style>
        body {
            height: 100%;
            width: 100%;
            background: #231e23;
            overflow: hidden;
        }

        .preloader {
            margin-top: 30vh;
        }

        .progress {
            margin-top: 10vh !important;
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

        .col,
        .row {
            margin-left: auto !important;
            margin-right: auto !important;
            padding: 0 !important;
        }

        .user_profile_img {
            padding-left: 20px !important;
            margin: 7% 0;
        }

        .chat-list {
            margin: 0 !important;
            padding: 0 !important;
            height: 100%;
            overflow-y: scroll;
        }

        .chat-list::-webkit-scrollbar {
            display: none;
        }

        .private_chat {
            overflow: clip;
            height: 100%;
            border-left: 2px solid darkslategrey;
        }

        .single_chat_left {
            overflow: hidden;
            height: 15vh;
            border-bottom: 2px solid darkslategrey;
        }

        .pc_upper_section {
            height: 10%;
            border-bottom: 2px solid darkslategray;
        }

        .pc_dp {
            transform: translateY(30px);
            padding-left: 30px !important;
            text-align: center;
        }

        .cl_upper_section {
            height: 10%;
            border-bottom: 2px solid darkslategray;
        }

        .cl_u_container {
            transform:translateY(-30px);
            padding: 1.52rem 0;
        }

        .cl_icons {
            padding-right: 20px;
        }

        .fa-circle-notch {
            transform: rotateZ(45deg) translateY(10px);
        }

        h4 {
            margin-top: 0 !important;
        }

        /* private chat */
        .chats {
            /* background-color: red; */
            background: linear-gradient(hsla(0, 0%, 10%, 0.1), hsla(0, 0%, 0%, 0.7)), url('img/doodle_bg.jpg');
            height: 90vh;
            background-size: cover;
        }

        .typing_space {
            padding: 0 20px !important;
            bottom: 0 !important;
            position: relative;
            top: 98%;
            transform: translateY(-100%);
        }

        .typing_space input {
            color: white;
            margin-bottom: 0 !important;
            padding: 0 20px !important;
            /* background: #231e23; */
        }

        .search_bar {
            color: white !important;
            padding: 0 0 0 28px !important;
            border-radius: 50px !important;
            border: 2px solid #9e9e9e !important;
            width: 90% !important;
        }

        .search {
            padding-top: 4px;
            border-bottom: 2px solid darkslategray;
        }

        .search_icon {
            transform: translateY(35px) translateX(-53px);
        }

        .user_right_profile {
            transform: translateY(-55px);
        }

        .top_name{
            transform: translateY(-10px);
        }
    </style>

    <script>
        // $(document).ready(function() {
        //     $('.main').hide();

        //     var s = 0;

        //     function stopLoading(int) {
        //         clearInterval(int);
        //     }

        //     var load1 = setInterval(function() {
        //         $('.determinate').css("width", s + "%");
        //         s++;
        //         if (s >= 50) {
        //             stopLoading(load1);
        //         }
        //     }, 20);

        //     var load2 = setInterval(function() {
        //         $('.determinate').css("width", s + "%");
        //         s++;
        //         if (s >= 75) {
        //             stopLoading(load2);
        //         }
        //     }, 50);

        //     var load3 = setInterval(function() {
        //         $('.determinate').css("width", s + "%");
        //         s++;
        //         if (s >= 110) {
        //             stopLoading(load3);
        //         }
        //     }, 75);
        //     setInterval(function() {
        //         $(".preloader").hide();
        //         $('.main').show();
        //     }, 3500);
        // });
    </script>

</head>

<body>
    <!-- <div class="preloader">
        <div class="container">
            <div class="logo-container">
                <img class="logo" src="img/loader.png" alt="Logo">
            </div>
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
            <div class="brand-text white-text center"> WhatsApp <br> <i class="fas white-text fa-unlock"></i> ! End-to-end encrypted </div>
        </div>
    </div> -->
    <section class="main">
        <?php if (empty($user_id)) : ?>
            <div class="section center white-text container">
                <h3 class="section">Session Expired Please Login again!</h3>
                <h5 class="section">You'll be automatically redirected to login page!</h5>
                <?php header("refresh:7;url=index.php"); ?>
            </div>
        <?php else : ?>
            <div class="chat-room">
                <div class="row">
                    <div class="col s3 chat-list white-text ">
                        <div class="cl_upper_section section">
                            <ul class=" cl_u_container right-align">
                                <li><i class="fas left fa-user-circle fa-2x" style="padding-left:20px;"></i></li>
                                <li class="right"><i class="fas cl_icons fa-ellipsis-h fa-lg"></i></li>
                                <li class="right"><i class="fas cl_icons fa-plus fa-lg"></i></li>
                                <li class="right"><i class="fas cl_icons fa-circle-notch fa-lg"></i></li>
                            </ul>
                        </div>
                        <div class="search"><i class="fas search_icon fa-search"></i>
                            <input type="text" class="search_bar" name="search_bar">
                        </div>
                        <?php for ($i = 0; $i < 20; $i++) : ?>
                            <div class="single_chat_left ">
                                <div class="row">
                                    <div class="col s4  user_profile_img">
                                        <i class="fas  fa-user-circle fa-3x"></i>
                                    </div>
                                    <div class="col s8">
                                        <h5>Name</h5>
                                        <p class="truncate">message Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, ullam.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="col s9 private_chat">
                        <?php include("private_chat.php"); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</body>

</html>