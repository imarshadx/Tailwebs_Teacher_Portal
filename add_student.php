<?php
include "database.php";
include "functions.php";
include "auth.php";

if (isset($_POST["name"])) {
    $name = formpost($db, "name");
    $subject = formpost($db, "subject");
    $mark = formpost($db, "mark");

    // Check For Errors
    $errors = array();

    if (strlen($name) < 1 || strlen($subject) < 1 || strlen($mark) < 1) {
        $errors[] = 'Please fill all the fields';
    } else if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors[] = 'Only alphabets and spaces are allowed in name';
    } else if (!is_numeric($mark)) {
        $errors[] = 'Invalid mark';
    }

    if (empty($errors)) {
        // Checking if a student with the same name and subject combination already exists in the database
        $query = "SELECT id FROM students WHERE name='$name' AND subject='$subject'";
        $userRows = mysqli_num_rows(mysqli_query($db, $query));

        if ($userRows > 0) {
            $query = "UPDATE students SET marks='$mark' WHERE subject='$subject' AND name='$name'";
            $updateMarks = mysqli_query($db, $query);
            $_SESSION["addStudent"] = '<br/><div class="alert alert-success"><strong><i class="fa fa-check"></i> Student With Same Subject Already Existed, New Marks Has Been Updated!</strong></div>';
        } else {
            $query = "INSERT INTO students (name, subject, marks, timestamp) VALUES ('$name', '$subject', '$mark', NOW())";
            $addUser = mysqli_query($db, $query);

            $_SESSION["addStudent"] = '<br/><div class="alert alert-success"><strong><i class="fa fa-check"></i> New Student Record Added!</strong></div>';
        }

        echo '<script>window.location.href = "students.php";</script>';
    } else {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger"><strong><i class="fa fa-close"></i> ' . $error . '</strong>.</div>';
        }
    }
}
?>
