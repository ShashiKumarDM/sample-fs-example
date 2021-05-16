<?php

include "./functions.php";


if(isset($_POST['addStudentData']) && 
    isset($_POST['id']) && 
    isset($_POST['studentName']) &&
    isset($_POST['studentUsn']) &&
    isset($_POST['studentAuid']) &&
    isset($_POST['studentBranch'])) {

        updateStudent(intval($_POST['id']), $_POST['studentName'], $_POST['studentUsn'], $_POST['studentAuid'], $_POST['studentBranch']);

        alertAndRedirect("Student data is updated", "/");

};