<?php

include "./functions.php";


if(isset($_GET['id'])) {

    deteleStudent(intval($_GET['id']));
    alertAndRedirect("Student data is deleted", "/");

};