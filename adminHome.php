<?php

ob_start();
session_start();
require_once 'database/dbAccess.php';

// if session is not admin and also not user, this will redirect to login page
if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['user'])){  //if you are a user but not an admin
    header("Location: home.php");
    exit;
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

    <link rel="stylesheet" href="library.css">

</head>
<body>
<div id="content">
    <header>
        <h1 class="font-weight-bold text-center p-1">Welcome to your second-hand Library!</h1>
        <div class="text-center p-1"><img class="col-md-1 col-3  " src="https://cdn.pixabay.com/photo/2014/03/25/16/27/literature-297187_960_720.png" alt=""></div>

    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 ">
        <a class="navbar-brand" href="index.php">Mini Lib</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Discover what we have:
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" value="all" href="index.php?type=all">All media</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="Books" href="index.php?type=book">Books</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="CD" href="index.php?type=cd">CD</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="DVD" href="index.php?type=dvd">DVD</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="publisher" href="publishersOnly.php">Sorted by publisher name</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="createMedia.php">Donate a media</a>
                </li>
                <li class="nav-item active ml-5">
                    <span class="nav-link" >Hi <?php echo  getUserNickname($userID); ?> !</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Sign Out</a>
                </li>


            </ul>

        </div>
    </nav>


            <div class='pt-5 text-center'>
                <h5>Welcome on the Admin side.</h5><br>
                <p>There are no functionalities here for the moment (coming soon)</p>
                <a class='btn btn-info' href='home.php'>Back to User's Home for now</a>
            </div>


</div>
</body>
</html>
<?php  ob_end_flush(); ?>
