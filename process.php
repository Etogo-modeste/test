<?php

session_start();


$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$name = '';

$location = '';

$update = false;

$id = 0;

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die($mysqli->error);



    $_session['message'] = "vos informations ont bien été enregistrées !";
    $_session['msg_type'] = "success";

    header("location: index.php");
}


if (isset($_GET['Delete'])) {
    $id = $_GET['Delete'];

    $mysqli->query("DELETE FROM data WHERE id = $id") or die($mysqli->error);

    $_SESSION['message'] = "vos informations ont bien été supprimées !";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['Edit'])) {
    $id = $_GET['Edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id = $id") or die($mysqli->error);

    /* 
    // this part of code is wrong...
     if (count($result) == 1) {
         $row = $result->fetch_array();
         $name = $row['name'];
        $location = $row['location'];
     }
     */

    $row = $result->fetch_array();
    $name = $row['name'];
    $location = $row['location'];
}

if (isset($_POST['Update'])) {
    // $id = 0;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location ='$location' WHERE id = $id") or die($mysqli->error);

    $_SESSION['message'] = "record has been Updated !";

    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
