<?php

ob_start();
session_start();
require_once 'database/dbAccess.php';

// if session is not admin and also not user, this will redirect to login page
if( !isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

?>
    <!DOCTYPE html>
    <html lang="en">
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
        <div class="text-center p-1"><img class="col-md-1 col-3 " src="https://cdn.pixabay.com/photo/2014/03/25/16/27/literature-297187_960_720.png" alt=""></div>

    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 ">
        <a class="navbar-brand" href="home.php">Mini Lib</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">



                <li class="nav-item active">
                    <a class="nav-link" href="#">Donate a media</a>
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



    <div id="mediaContent" class="container mt-sm-5 col-8 ">

        <?php
        if($_POST){
            $title = $_POST["title"];
            $publishDate = $_POST["publishDate"];
            $type = $_POST["type"];
            $category = $_POST["category"];
            $description = $_POST["description"];
            $ISBN = $_POST["ISBN"];
            $imageLink = $_POST["imageLink"];
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $name = $_POST["name"];
            $adress = $_POST["adress"];
            $size = $_POST["size"];

$result= createMedia($title,$publishDate,$type,$category,$description,$ISBN,$imageLink,$firstName, $lastName,$name,$adress,$size);


            if($result == TRUE){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <a class=' btn btn-light'   href='home.php'>back to homepage</a>
                          <span class='pl-3'><strong>Thank you for your donation!</strong> Just put your media in our Box. </span>    
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <br>";

            }else{
                echo "error";
            }
        }


        ?>
        <form class="col-10 mx-auto" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >


            <h2>Thanks for your donation, please fill in the media into:</h2>
            <hr />

            Title:
                <input class ="form-control" type="text" name="title" id="title" placeholder ="Enter Title"  maxlength ="50"  /><br>

            Publication's year:
                <input class ="form-control" type="text" name="publishDate" id="publishDate" placeholder ="Enter the year of publication, i.e. 2006"  maxlength ="4"  /><br>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Type of media:</label>
                </div>
                <select name="type" class="custom-select" id="inputGroupSelect01">
                    <option name="type" value="Book" selected>Choose...</option>
                    <option  name="type" value="Book">Books</option>
                    <option name="type" value="CD">CD</option>
                    <option name="type" value="DVD">DVD</option>
                </select>
            </div>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Category:</label>
                </div>
                <select name="category" class="custom-select " id="inputGroupSelect02">
                    <option name="category" value="Diverse" selected>Choose...</option>
                    <option name="category" value="Novel">Novel</option>
                    <option name="category" value="Fiction">Fiction</option>
                    <option name="category" value="Biography">Biography</option>
                    <option name="category" value="Horror">Horror</option>
                    <option name="category" value="Children">Children</option>
                    <option name="category" value="Manga">Manga</option>
                    <option name="category" value="Comic">Comic</option>
                    <option name="category" value="Health">Health</option>
                    <option name="category" value="Education">Education</option>
                    <option name="category" value="Diverse">Diverse</option>
                </select>
            </div>

            Small description:
            <input class ="form-control" type="text" name="description" id="description" placeholder ="Enter a small description of your media"  maxlength ="500"  /><br>

            ISBN (only for books):
            <input class ="form-control" type="text" name="ISBN" id="ISBN" placeholder ="Enter the ISBN number of your book"  maxlength ="20"  /><br>

            Cover link:
            <input class ="form-control" type="text" name="imageLink" id="imageLink" placeholder ="Copy here a link for the cover of your media"  maxlength ="500"  /><br>

            Author's first name:
            <input class ="form-control" type="text" name="firstName" id="firstName" placeholder ="Enter Author's first name"  maxlength ="50"  /><br>

            Author's last name:
            <input class ="form-control" type="text" name="lastName" id="lastName" placeholder ="Enter Author's last name"  maxlength ="50"  /><br>

            Publisher's name:
            <input class ="form-control" type="text" name="name" id="name" placeholder ="Enter Publisher's name"  maxlength ="50"  /><br>

            Publisher's adress (if known):
            <input class ="form-control" type="text" name="adress" id="adress" placeholder ="Enter Publisher's adress or city (if known)"  maxlength ="200"  /><br>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Publisher's size:</label>
                </div>
                <select name="size" class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option name="size" value="big">big</option>
                    <option name="size" value="medium">medium</option>
                    <option name="size" value="small">small</option>
                </select>
            </div>


            <hr />

            <button   type = "submit"   class = "btn btn-block btn-info"   name = "donate" >Create your Media</button >
            <hr  />



        </form >

    </div>
</div>
</body>
</html>
<?php  ob_end_flush(); ?>
