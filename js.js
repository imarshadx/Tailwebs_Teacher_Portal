var Timeout=1000; 
var TimeoutMsg="<img src='loading.gif'><br/><br/>";

$(document).ready(function()
{


$(document).on('submit','#addStudent_form',function(e)
        {
        e.preventDefault();
        $('#addStudent_msg').html(TimeoutMsg);
        $.ajax(
        {
        method:"POST",
        url: "add_student.php",
        data:$(this).serialize(),
        success: function(data)
        {
        setTimeout(function () {
        $('#addStudent_msg').html(data);
        }, Timeout);
        }
        
        });

        });

});

function displayMsg(divid, data) {
            document.getElementById(divid).innerHTML = data;
            setTimeout(function() { document.getElementById(divid).innerHTML = ''; }, 2000);
    }

function confirmDelete(studentId) {
        if (confirm("Are you sure you want to delete this entry?")) {
            document.getElementById('deleteStudentId').value = studentId;
            document.getElementById('deleteStudentForm').submit();
        }
    }

function editRow(id) {
        // Show input fields for editing
        document.getElementById('name_' + id).style.display = 'none';
        document.getElementById('input_name_' + id).style.display = 'block';

        document.getElementById('subject_' + id).style.display = 'none';
        document.getElementById('input_subject_' + id).style.display = 'block';

        document.getElementById('marks_' + id).style.display = 'none';
        document.getElementById('input_marks_' + id).style.display = 'block';

        // Change dropdown button to save/cancel
        document.getElementById('dropdownMenuButton_' + id).innerHTML = ' Save';
        document.getElementById('dropdownMenuButton_' + id).setAttribute('onclick', 'saveRow(' + id + ')');
    }

function saveRow(id) {
        // Get updated values
        var name = document.getElementById('input_name_' + id).value;
        var subject = document.getElementById('input_subject_' + id).value;
        var marks = document.getElementById('input_marks_' + id).value;

        // AJAX request to update the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_student.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status == 200) {
                if (xhr.responseText == 'success') {
                    // Update UI with new values
                    document.getElementById('name_' + id).innerText = name;
                    document.getElementById('subject_' + id).innerText = subject;
                    document.getElementById('marks_' + id).innerText = marks;
                } else {
                    alert('Error updating record: ' + xhr.responseText);
                }
            } else {
                alert('Error: ' + xhr.status);
            }
        };
        xhr.onerror = function() {
            alert('Request failed');
        };
        xhr.send('edit_id=' + id + '&name=' + name + '&subject=' + subject + '&marks=' + marks);

        // Hide input fields and revert dropdown to edit
        document.getElementById('name_' + id).style.display = 'block';
        document.getElementById('input_name_' + id).style.display = 'none';

        document.getElementById('subject_' + id).style.display = 'block';
        document.getElementById('input_subject_' + id).style.display = 'none';

        document.getElementById('marks_' + id).style.display = 'block';
        document.getElementById('input_marks_' + id).style.display = 'none';

        document.getElementById('dropdownMenuButton_' + id).innerHTML = '';
        document.getElementById('dropdownMenuButton_' + id).setAttribute('onclick', 'editRow(' + id + ')');
        
        document.getElementById('display_msg').innerHTML = '<br/><div class="alert alert-success"><strong>Student Record Updated Successfully.</strong></div>';
        setTimeout(function() { document.getElementById('display_msg').innerHTML = ''; }, 2000);

    }