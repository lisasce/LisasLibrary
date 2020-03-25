<?php
require_once 'function.php';
require_once 'DBconnect.php';

function passwordCheck(){
    $pass = $_POST["pass"];
    $passVerif= $_POST["passVerif"];

    if($pass == $passVerif){
        echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span> Passwords match</label>';
    }else {
        echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Passwords not match</label>';
    }
}

function check_email_availability(){
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';
    } elseif(is_email_available($_POST["email"])) {
        echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';
    }else {
        echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';
    }
}

function is_email_available($email){
    $conn = connect();
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if($query->num_rows == 0) {
        return true;
    } else {
        return false;
    }
}


$userID = isset($_SESSION['user']) ? $_SESSION['user'] : $_SESSION['admin'];
function getUserNickname($userID){
    $conn = connect();
    $res=mysqli_query($conn, "SELECT * FROM users WHERE userID=".$userID);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    $conn->close();
    return $userRow['nickName'];

}


function createMedia($title,$publishDate,$type,$category,$description,$ISBN,$imageLink,$firstName, $lastName,$name,$adress,$size){
    $conn = connect();
    $title = clearString($title);
    $publishDate = clearString($publishDate);
    $type = clearString($type);
    $category = clearString($category);
    $description = clearString($description);
    $ISBN = clearString($ISBN);
    $imageLink = clearString($imageLink);
    $firstName = clearString($firstName);
    $lastName = clearString($lastName);
    $name = clearString($name);
    $adress = clearString($adress);
    $size = clearString($size);

    $sqlSearch = "SELECT * FROM author WHERE firstName = '$firstName' AND lastName = '$lastName'";
    $res = mysqli_query($conn, $sqlSearch);
    if($res->num_rows == 0){

        $sql1 = "
    INSERT INTO `author`(`firstName`, `lastName`) VALUES ('$firstName', '$lastName')";

    $res1 = mysqli_query($conn, $sql1);
    $last_idAuthor =  mysqli_insert_id($conn);
    }else {
        $result = $res->fetch_assoc();
        $last_idAuthor = $result["authorID"];

    }

    $sqlSearchPub = "SELECT * FROM publishers WHERE name = 'name'";
    $resPub = mysqli_query($conn, $sqlSearchPub);
    if($resPub->num_rows == 0){
        $sql = "INSERT INTO `publishers`(`name`, `adress`, `size`) VALUES ('$name', '$adress', '$size')";
        mysqli_query($conn, $sql);
        $last_idPublisher =  mysqli_insert_id($conn);
    }else {
        $result2 = $resPub->fetch_assoc();
        $last_idPublisher = $result["publisherID"];
    }



    $sql2 = "INSERT INTO `medias`(`title`, `publishDate`, `type`, `category`, `description`, `ISBN`, `imageLink`,`fk_authorID`,`fk_publisherID`) VALUES ('$title', '$publishDate', '$type', '$category', '$description','$ISBN', '$imageLink', $last_idAuthor, $last_idPublisher)";

    $finalRes = mysqli_query($conn, $sql2);
    if($finalRes){
        $conn->close();
        return true;
    }else {
        $conn->close();
        return "error";
    }

}


function deleteMedia($id){
    $conn = connect();
    $sql = "DELETE FROM `medias` WHERE mediaID = $id";

    $res= mysqli_query($conn, $sql);
    $conn->close();
    return $res;


};
/* to add for project expansion - $firstName, $lastName,$name,$adress,$size*/
function updateMedia( $id, $title,$publishDate,$type,$category,$description,$ISBN,$imageLink){
    $conn = connect();
    $title = clearString($title);
    $publishDate = clearString($publishDate);
    $type = clearString($type);
    $category = clearString($category);
    $description = clearString($description);
    $ISBN = clearString($ISBN);
    $imageLink = clearString($imageLink);

    /*   FOR PROJECT EXPANSION
    $firstName = clearString($firstName);
    $lastName = clearString($lastName);
    $name = clearString($name);
    $adress = clearString($adress);
    $size = clearString($size);
    UPDATE `author` SET `firstName`= '$firstName', `lastName`='$lastName';
    UPDATE `publishers` SET `name`='$name', `adress`='$adress', `size`='$size'*/

     $sql = "
    UPDATE `medias` SET `title`= '$title', `publishDate` = '$publishDate', `type` = '$type', `category` = '$category', `description` = '$description', `ISBN` = '$ISBN', `imageLink` = '$imageLink' WHERE mediaID = $id";

    $res= mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}

function publishersWork(){
    $conn = connect();
    $sql = "SELECT `publisherID`, `name`, `title`, `type`, `publishDate` FROM `publishers`
INNER JOIN medias ON medias.fk_publisherID = publisherID ORDER by publisherID";

    $media=mysqli_query($conn, $sql);
    $result = $media->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}


function publisherSelection( $pubID){
    $conn = connect();
    $sql = "SELECT  `title`, `type`, `publishDate` FROM `publishers`
INNER JOIN medias ON medias.fk_publisherID = publisherID where publisherID= $pubID";

    $media=mysqli_query($conn, $sql);
    $result = $media->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}


function mediaDetail( $mediaID){
    $conn = connect();
    $sql = "SELECT  * FROM `medias`
INNER JOIN publishers ON medias.fk_publisherID = publisherID 
INNER JOIN author ON medias.fk_authorID = authorID  
where mediaID= $mediaID";

    $media=mysqli_query($conn, $sql);
    $result = $media->fetch_assoc();
    $conn->close();
    return $result;
}



?>
