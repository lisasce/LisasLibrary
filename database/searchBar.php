<?php

require_once 'dbAccess.php';
$conn = connect();
$name =  $_POST['search'];

$result = $conn->query("
SELECT * FROM `medias` 
INNER JOIN `author` ON `fk_authorID`= `authorID`
WHERE `title` LIKE '$name%'
OR
`firstName` LIKE '$name%'
OR
`lastName` LIKE '$name%'
");

$output = $result->fetch_all(MYSQLI_ASSOC);
foreach($output as $searchresult){

    echo "
                        <div class='col-lg-6 col-12 text-center'>
                            <div class='thumbnail mt-3'>
                                <img class='w-25' src='". $searchresult['imageLink']."' alt=\"Lights\" style='width:50%'>
                                <div class='caption'>
                                  <p><strong>" . $searchresult["title"] . "</strong></p>
                                  <p>" . $searchresult["category"] . " <br> " . $searchresult["type"] . "</p>
                                  <p><a class='btn btn-danger' href='deleteMedia.php?id=".$searchresult['mediaID' ]."'>Delete</a> 
                             <a class='btn btn-info mt-1 mb-1' href='showDetail.php?id=".$searchresult['mediaID']."'>Details</a>
                            <a class=' btn btn-warning ' href='updateMedia.php?id=".$searchresult['mediaID']."'>Update</a></p>
                                </div>
                            </div>
                          </div>
                ";


}
?>
