<?php

include('config/db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];

echo $user_id;


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp</title>
    <?php include('cdns.php'); ?>
</head>

<body>
    <?php if (empty($user_id)) : ?>
        <div class="section container">
            
        </div>

    <?php endif; ?>

</body>

</html>