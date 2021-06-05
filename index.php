<?php

session_start();
include('config/db_connect.php');
$_SESSION['user_id'] = "";


$reg_user_name = $user_number = $user_password = $reg_user_password = $reg_user_number = "";
$errors = ['reg_user_name' => '', 'user_number' => '', 'user_password' => '', 'reg_user_number' => '', 'reg_user_password' => ''];

if (isset($_POST['login'])) {
    $user_number = mysqli_real_escape_string($conn, $_POST['user_number']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);

    //validating user number
    if (empty($user_number)) {
        $errors['user_number'] = "Please enter Phone number";
    } elseif (!filter_var($user_number, FILTER_SANITIZE_NUMBER_INT)) {
        $errors['user_number'] = "Phone number must be numbers";
    } elseif (strlen($user_number) != 10) {
        $errors['user_number'] = "Phone number should be 10 numbers";
    }

    //validating user password
    if (empty($user_password)) {
        $errors['user_password'] = "Please enter Password";
    } elseif (strlen($user_password) < 8) {
        $errors['user_password'] = "Password should be atleast 8 characters";
    }

    if (array_filter($errors)) {
        // echo "Errors are there";
    } else {
        $sql = "SELECT * FROM users WHERE user_number='$user_number'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $id = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $id['user_id'];
            header('Location: preloader.php');
        } else {
            $errors['user_number'] = "Phone number not found in database <br> please check your number or register";
        }
    }
}

if (isset($_POST['register'])) {
    $reg_user_number = mysqli_real_escape_string($conn, $_POST['reg_user_number']);
    $reg_user_password = mysqli_real_escape_string($conn, $_POST['reg_user_password']);
    $reg_user_name = mysqli_real_escape_string($conn, $_POST['reg_user_name']);


    //validating user number
    if (empty($reg_user_number)) {
        $errors['reg_user_number'] = "Please enter Phone number";
    } elseif (!filter_var($reg_user_number, FILTER_SANITIZE_NUMBER_INT)) {
        $errors['reg_user_number'] = "Phone number must be numbers";
    } elseif (strlen($reg_user_number) != 10) {
        $errors['reg_user_number'] = "Phone number should be 10 numbers";
    }

    //validating user password
    if (empty($reg_user_password)) {
        $errors['reg_user_password'] = "Please enter Password";
    } elseif (strlen($reg_user_password) < 8) {
        $errors['reg_user_password'] = "Password should be atleast 8 characters";
    }

    //validating user name
    if (empty($reg_user_name)) {
        $errors['reg_user_name'] = "Please enter Name";
    }

    if (array_filter($errors)) {
        // echo "Errors are there";
    } else {
        $sql = "INSERT INTO users (user_name,user_password,user_number) VALUES ('$reg_user_name','$reg_user_password','$reg_user_number')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: preloader.php');
        } else {
            echo mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whatsapp</title>
    <?php include('cdns.php'); ?>
    <style>
        .input-field {
            padding: 3vh 0vw;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.register_page').hide();
            $('input').addClass("white-text");
            $('.switch').click(function() {
                if ($(".login_page").css("display") == "block") {
                    $(".register_page").show();
                    $(".login_page").hide();
                } else {
                    $(".register_page").hide();
                    $(".login_page").show();
                }
            });
        });
    </script>
</head>

<body>
    <div class="center white-text container section login_page">
        <h3>Login</h3>
        <div class="section">
            <form action="index.php" method="POST">
                <div class="input-field">
                    <input type="tel" id="user_number" name="user_number" value=<?php echo $user_number ?>>
                    <label for="user_number">Phone number </label>
                </div>
                <div class="red-text center-align">
                    <?php echo $errors['user_number'] ?>
                </div>
                <div class="input-field">
                    <input type="password" id="user_password" name="user_password" value=<?php echo $user_password ?>>
                    <label for="user_password">Password</label>
                </div>
                <div class="red-text center-align" style="margin-bottom:20px;">
                    <?php echo $errors['user_password'] ?>
                </div>
                <div class="center">
                    <input type="submit" name="login" class="btn" value="Login" id="login">
                </div>
                <div class="right-align right-align">
                    <p> <a href="#" class="switch teal-text"> New user? Register here</a></p>
                </div>
            </form>
        </div>
    </div>
    <div class="center white-text container section register_page">
        <h3>Register</h3>
        <div class="section">
            <form action="index.php" method="POST">
                <div class="input-field">
                    <input type="text" name="reg_user_name" id="reg_user_name" value=<?php echo $reg_user_name ?>>
                    <label for="reg_user_name">Name</label>
                </div>
                <div class="red-text center-align">
                    <?php echo $errors['reg_user_name'] ?>
                </div>
                <div class="input-field">
                    <input type="tel" id="reg_user_number" name="reg_user_number" value=<?php echo $reg_user_number ?>>
                    <label for="reg_user_number">Phone number </label>
                </div>
                <div class="red-text center-align">
                    <?php echo $errors['reg_user_number'] ?>
                </div>
                <div class="input-field">
                    <input type="password" id="reg_user_password" name="reg_user_password" value=<?php echo $reg_user_password ?>>
                    <label for="reg_user_password">Password</label>
                </div>
                <div class="red-text center-align" style="margin-bottom:20px;">
                    <?php echo $errors['reg_user_password'] ?>
                </div>
                <div class="center">
                    <input type="submit" name="register" class="btn" value="Register" id="register">
                </div>
                <div class="right-align">
                    <p> <a href="#" class="switch teal-text"> Existing user? Login here</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>