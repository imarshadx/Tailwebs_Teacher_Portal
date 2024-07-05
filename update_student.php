<?php

include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {

    $edit_id = intval($_POST['edit_id']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $marks = intval($_POST['marks']); 

    
    $updateQuery = "UPDATE students SET name='$name', subject='$subject', marks=$marks WHERE id=$edit_id";

    
    $updateResult = mysqli_query($db, $updateQuery);

    
    if ($updateResult) {
        echo "success";
    } 
    else {
        echo "error: " . mysqli_error($db);
    }

} 
else 
{
    
    echo "error: Invalid request";
}
?>
