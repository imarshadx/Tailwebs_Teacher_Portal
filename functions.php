<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Kolkata');

// User Session Authentication Verification
$sessionUser = mysqli_real_escape_string($db, $_SESSION["username"]);
$sessionPass = mysqli_real_escape_string($db, $_SESSION["password"]);
$query = "SELECT id FROM teachers WHERE username='$sessionUser' AND password='$sessionPass'";
$checkUserLogin = mysqli_num_rows(mysqli_query($db, $query));

if ($checkUserLogin > 0) {
    $userLog = 1;
} else {
    $userLog = 0;
}

function headtag($headTitle)
{
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $headTitle . '</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="js.js"></script>
    </head>
    <body>';
}

function formget($db, $val)
{
    $val = mysqli_real_escape_string($db, $_GET["$val"]);
    return $val;
}

function formpost($db, $val)
{
    $val = mysqli_real_escape_string($db, $_POST["$val"]);
    return $val;
}
?>
