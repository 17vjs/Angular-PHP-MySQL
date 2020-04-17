<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phptraining";

$conn = new mysqli($servername, $username, $password, $dbname);
$data = json_decode(file_get_contents("php://input"));

$uname = $data->uname ?? ' ';
$pass = $data->pass ?? ' ';
$address1 = $data->address1 ?? ' ';
$address2 = $data->address2 ?? ' ';
$city = $data->city ?? ' ';
$state = $data->state ?? ' ';
$zip = $data->zip ?? ' ';
$ch = $data->check ?? ' ';
$operation = $data->operation ?? ' ';

if ($operation == 'insert') {
     $query = "insert into users values('$uname','$pass','$address1','$address2','$city','$state','$zip','$ch')";
     if ($conn->query($query) == TRUE) {
          echo "Insert successful ";
     } else {
          echo "Insert failed";
     }
}

if ($operation == 'delete') {
     $sqlquery = "delete from users where uname='$uname'";
     if ($conn->query($sqlquery) == TRUE) {
          echo "Record deleted successfully";
     }
}
if ($operation == 'update') {
     $sqlquery = "update users set pass='$pass' where uname='$uname'";

     if ($conn->query($sqlquery) == TRUE) {
          echo "Record updated successfully";
     }
}
if ($operation == 'select') {
     $output = array();
     if ($uname == ' ') {

          $query = "SELECT * FROM users";
     } else {

          $query = "SELECT * FROM users where uname='$uname'";
     }
     $result = mysqli_query($conn, $query);
     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
               $output[] = $row;
          }
          echo json_encode($output);
     }
}
