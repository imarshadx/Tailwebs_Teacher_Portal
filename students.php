<?php
include "database.php";
include "functions.php";
include "auth.php";

headtag("Teacher Portal");
include "header.php";
?>

<div class="container mt-4">

<?php
if (isset($_SESSION["addStudent"])) {
    echo $_SESSION["addStudent"];
    unset($_SESSION["addStudent"]);
}
echo '<div id="display_msg"></div>';

if (isset($_POST["delete_id"])) {
    $delete_id = intval($_POST["delete_id"]);
    $deleteQuery = "DELETE FROM students WHERE id = $delete_id";
    $deleteResult = mysqli_query($db, $deleteQuery);

    if ($deleteResult) {
        echo '<script type="text/javascript">displayMsg("display_msg","<br/><div class=\'alert alert-success\'><strong>Student Record Deleted Successfully.</strong></div>");</script>';
    } else {
        echo '<script type="text/javascript">displayMsg("display_msg","Error Deleting Record: '.mysqli_error($db).'");</script>';
    }
}


?>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Mark</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $studentsList = mysqli_query($db, "SELECT * FROM students ORDER BY id DESC");

        if (mysqli_num_rows($studentsList) > 0) {
            while ($rows = mysqli_fetch_array($studentsList)) {
                $id = $rows["id"];
                $name = $rows["name"];
                $subject = $rows["subject"];
                $marks = $rows["marks"];
                $firstChar = strtoupper(substr($name, 0, 1)); 
        ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" style="width: 30px; height: 30px;"><?php echo $firstChar; ?></div>
                            <span id="name_<?php echo $id; ?>"><?php echo $name; ?></span>
                            <input type="text" id="input_name_<?php echo $id; ?>" class="form-control" value="<?php echo $name; ?>" style="display: none;">
                        </div>
                    </td>
                    <td>
                        <span id="subject_<?php echo $id; ?>"><?php echo $subject; ?></span>
                        <input type="text" id="input_subject_<?php echo $id; ?>" class="form-control" value="<?php echo $subject; ?>" style="display: none;">
                    </td>
                    <td>
                        <span id="marks_<?php echo $id; ?>"><?php echo $marks; ?></span>
                        <input type="text" id="input_marks_<?php echo $id; ?>" class="form-control" value="<?php echo $marks; ?>" style="display: none;">
                    </td>
                    <td>
                        <div class="dropdown">
                            <i class="fas fa-caret-down rounded-pill" id="dropdownMenuButton_<?php echo $id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:black;color:white;padding:5px;"></i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $id; ?>">
                                <small><a class="dropdown-item" href="#" onclick="editRow(<?php echo $id; ?>)">Edit</a></small>
                                <small><a class="dropdown-item" href="#" onclick="confirmDelete(<?php echo $id; ?>)">Delete</a></small>
                            </div>
                        </div>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="4" class="text-center">No Records Found.</td></tr>';
        }
        ?>
    </tbody>
</table>
</div>

<div class="container mb-4" style="background-color:#EBEBEB;">
    <button class="btn btn-dark btn-block ml-0" data-toggle="modal" data-target="#addStudentModal">Add</button>
</div>


<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:50px">
            <div class="modal-body">
                <div id="addStudent_msg" style="text-align: center;"></div>
                <form id="addStudent_form">
                    <div class="form-group">
                        Name
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Enter student name">
                        </div>
                    </div>

                    <div class="form-group">
                        Subject
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                        </div>
                    </div>

                    <div class="form-group">
                        Mark
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                            </div>
                            <input type="text" name="mark" class="form-control" placeholder="Enter mark">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-block">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


<form id="deleteStudentForm" method="post" style="display: none;">
    <input type="hidden" name="delete_id" id="deleteStudentId">
</form>

</body>
</html>
