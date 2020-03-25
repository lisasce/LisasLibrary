
<?php

ob_start();
session_start();
require_once 'database/dbAccess.php';
require_once 'database/function.php';
$conn = connect();
// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user' ])!="") {
    header("Location: home.php");
    exit;
}
if(isset($_SESSION['admin']) != ''){
    header('Location: adminHome.php');
    exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {
    $email = clearString($_POST["email"]);
    $pass = clearString($_POST["pass"]);


    if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)){
        $error = true;
        $passError = "Please enter your password." ;
    }

    // if there's no error, continue to login
    if (!$error) {

        $pass = hash( 'sha256', $pass); // password hashing


        $res=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'" );
        $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res); // if name/pass is correct it returns must be 1 row

        if( $count == 1 && $row['userPass' ]==$pass ) {
            if($row['userStatus'] == 'user'){
                $_SESSION['user'] = $row['userID'];
                header( "Location: home.php");
            }else {
                $_SESSION['admin'] = $row['userID'];
                header("Location: adminHome.php");
            }

        } else {
            $errMSG = "Incorrect Credentials, Try again..." ;
        }

    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>2d Hand Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Icon library -->
    <script src="https://kit.fontawesome.com/d94fa60402.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="library.css">

</head>
<body>
<div id="content">
    <header>
        <h1 class="font-weight-bold text-center p-1">Welcome to your second-hand Library!</h1>
        <div class="text-center p-1"><img class="col-md-1 col-3"  " src="https://cdn.pixabay.com/photo/2014/03/25/16/27/literature-297187_960_720.png" alt=""></div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 ">
        <a class="navbar-brand" href="#">Mini Lib</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


    </nav>



    <div id="mediaContent" class="container mt-sm-5 col-8 ">

        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">


            <h2>Sign In.</h2 >
            <hr />

            <?php
            if ( isset($errMSG) ) {
                echo  $errMSG; ?>

                <?php
            }
            ?>



            <input  type="email" id="loginEmail" name="email"  class="form-control" placeholder= "Your Email" value="<?php echo $email; ?>"  maxlength="40" />

            <span class="text-danger"><?php  echo $emailError; ?></span >


            <input  type="password" id="loginPw" name="pass"  class="form-control" placeholder ="Your Password" maxlength="25"  />

            <span  class="text-danger"><?php  echo $passError; ?></span>
            <hr />
            <button class = "btn btn-block btn-info" type="submit" name= "btn-login">Sign In</button>


            <hr />

            <a  href="register.php">Sign Up Here...</a>


        </form>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="JS/jsFunctions.js"></script>
</body>
</html>
<?php  ob_end_flush(); ?>
