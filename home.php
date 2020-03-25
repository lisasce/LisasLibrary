
<?php
ob_start();
session_start();
require_once 'database/dbAccess.php';
$conn = connect();
//require_once 'DBconnect.php';
// if session is not admin and also not user, this will redirect to login page
if( !isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
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
    <!-- Icon library -->
    <script src="https://kit.fontawesome.com/d94fa60402.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="library.css">

</head>
<body>
    <div id="content">
        <header>
        <h1 class="font-weight-bold text-center p-1">Welcome to your second-hand Library!</h1>
            <div class="text-center p-1"><img class="col-md-1 col-3" src="https://cdn.pixabay.com/photo/2014/03/25/16/27/literature-297187_960_720.png" alt=""></div>
        </header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 ">
            <a class="navbar-brand" href="home.php">Mini Lib</a>
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
                            <a class="dropdown-item" value="all" href="home.php?type=all">All media</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" value="book" href="home.php?type=book">Books</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" value="CD" href="home.php?type=CD">CD</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" value="DVD" href="home.php?type=DVD">DVD</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" value="publisher" href="publishersOnly.php">Sorted by publisher name</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="createMedia.php">Donate a media</a>
                    </li>
                    <li class="nav-item active ml-5">
                        <span class="nav-link" >Hi <?php echo getUserNickname($userID); ?> !</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?logout">Sign Out</a>
                    </li>

                </ul>


                <form id="form" class="form-inline active-cyan active-cyan-2 " autocomplete= "off">
                    <i class="fas fa-search active-cyan" aria-hidden="true"></i>
                    <input id="input" class="form-control form-control-sm ml-3 w-85"  type="text" name= "search" placeholder="Search by Title or Author"
                           aria-label="Search">
                </form>

            </div>
        </nav>



        <div id="mediaContent" class="container  mt-sm-5 col-8 ">
            <div id="message" class="row ">
            <?php

            $selectedFilter = $_GET["type"];

            switch ($selectedFilter) {
                case "book":
                   $mediaQ= "SELECT * FROM medias WHERE type= 'book' ";
        break;
                case "CD":
                    $mediaQ= "SELECT * FROM medias WHERE type= 'CD' ";
        break;
                case "DVD":
                    $mediaQ= "SELECT * FROM medias WHERE type= 'DVD' ";
        break;
                default:
                    $mediaQ= "SELECT * FROM medias ";
            }

            $media=mysqli_query($conn, $mediaQ);
            $mediaRow = $media->fetch_all(MYSQLI_ASSOC);


            foreach ($mediaRow as $value) {

//                echo "<div class='mediaVisibility media mr-3 ml-3'>
//                            <img src='". $value['imageLink']."' class='mr-3 col-2 img-thumbnail' alt='...'>
//                            <div class='media-body'>
//                                <h5 class='mt-0'>" . $value["title"] . "</h5>
//                                " . $value["category"] . " <br> " . $value["type"] . " - " . $value["publishDate"].
//                                "<br>Available: " . $value["available"]
//                                ."<br>description: " . $value["description"] . "   <br>
//                             </div>
//
//                             <div>
//                             <a class='btn btn-danger' href='deleteMedia.php?id=".$value['mediaID' ]."'>Delete</a> <br>
//                             <a class='btn btn-info mt-1 mb-1' href='showDetail.php?id=".$value['mediaID']."'>Details</a><br>
//                             <a class=' btn btn-warning ' href='updateMedia.php?id=".$value['mediaID']."'>Update</a>
//                            </div>
//                        </div>";
                echo "
                        <div class='mediaVisibility col-lg-6 col-12 text-center'>
                            <div class='thumbnail mt-3'>
                                <img class='w-25' src='". $value['imageLink']."' alt=\"Lights\" style='width:50%'>
                                <div class='caption'>
                                  <p><strong>" . $value["title"] . "</strong></p>
                                  <p>" . $value["category"] . " <br> " . $value["type"] . "</p>
                                  <p><a class='btn btn-danger' href='deleteMedia.php?id=".$value['mediaID' ]."'>Delete</a> 
                             <a class='btn btn-info mt-1 mb-1' href='showDetail.php?id=".$value['mediaID']."'>Details</a>
                            <a class=' btn btn-warning ' href='updateMedia.php?id=".$value['mediaID']."'>Update</a></p>
                                </div>
                            </div>
                          </div>
                ";
            }


            ?>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script>
        var request;
        // Bind to the submit event of our form (id for the form tag)
        $("#input").keyup(function(event){
            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();
            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);
            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");
            // Serialize the data in the form
            var serializedData = $form.serialize();
            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);
            // Fire off the request to /form.php
            request = $.ajax({
                url: "database/searchBar.php",
                type: "post",
                data: serializedData
            });
            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                console.log("request status: success");
                document.getElementById("message").innerHTML = response;

            });
            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });
            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Reenable the inputs
                $inputs.prop("disabled", false);
                if($("#input").val() != ''){
                    $(".mediaVisibility").hide();
                }
                else{
                    $(".mediaVisibility").show();
                    $("#message").html("");
                }
            });


        });




    </script>

</body>
</html>
<?php ob_end_flush(); ?>
