<?php
ob_start();
session_start();
require_once 'database/dbAccess.php';
require_once 'database/function.php';
$conn = connect();

if( isset($_SESSION['user'])!="" ){ //if session user is not empty - when u never registered it's empty, first when you login there will be a value
    header("Location: home.php" ); // redirects to home.php
}
//include_once 'DBconnect.php';
$error = false; //first time we open the page we will have no error
if ( isset($_POST['btn-signup']) ) {
    $nickName = clearString($_POST["nickName"]);
    $email = clearString($_POST["email"]);
    $pass = clearString($_POST["pass"]);


    // basic name validation
    if (empty($nickName) ){
        $error = true ;
        $nameError = "Please enter your nickname.";
    } else if (strlen($nickName) < 3) {
        $error = true;
        $nameError = "Nickame must have at least 3 characters.";
    } else if(!preg_match("/^[a-zA-Z- ]+$/",$nickName)) {
        $error = true;
        $nameError = "Nickame must contain alphabets and space.";
    }

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address." ;
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters." ;
    }

    // password hashing for security
    $pass = hash('sha256' , $pass);

    // if there's no error, continue to signup
    if( !$error ) {
        $query = "INSERT INTO users(nickName, email ,userPass) VALUES( '$nickName','$email','$pass')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            unset($nickName);
            unset($email);
            unset($pass);
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
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
        <div class="text-center p-1"><img class="col-md-1 col-3 " src="https://cdn.pixabay.com/photo/2014/03/25/16/27/literature-297187_960_720.png" alt=""></div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 ">
        <a class="navbar-brand" href="#">Mini Lib</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>

    <div id="mediaContent" class="container mt-sm-5 col-8 ">

        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >


            <h2>Sign Up.</h2>
            <hr />

            <?php
            if ( isset($errMSG) ) {

                ?>
                <div  class="alert alert-<?php echo $errTyp ?>" >
                    <?php echo  $errMSG; ?>
                </div>

                <?php
            }
            ?>

            <input type ="text"  name="nickName"  class ="form-control"  placeholder ="Enter your Nickname"  maxlength ="50"   value = "<?php echo $nickName ?>"  />

            <span   class = "text-danger" > <?php   echo  $nameError; ?> </span >

            <input   type = "email" id="email"  name = "email"   class = "form-control"   placeholder = "Enter Your Email"   maxlength = "40"   value = "<?php echo $email ?>"  />
            <span id="email_result"></span>
            <span   class = "text-danger" > <?php   echo  $emailError; ?> </span >


            <input   type = "password" id="pass"  name = "pass"   class = "form-control"   placeholder = "Enter Password"   maxlength = "15"  />

            <span   class = "text-danger" > <?php   echo  $passError; ?> </span >

            <input   type = "password"   id="passVerif" name= "passVerif"   class = "form-control"   placeholder = "Verify your Password"   maxlength = "15"  />
            <span id="pw_result"></span>

            <span   class = "text-danger" > <?php   echo  $passError; ?> </span >

            <hr />

            <button  id="submitBtn" type = "submit"   class = "btn btn-block btn-info"   name = "btn-signup" >Sign Up</button >
            <hr  />

            <a   href = "index.php" >Sign in Here...</a>


        </form >

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="JS/jsFunctions.js"></script>

</body>
</html>

<?php  ob_end_flush(); ?>
