<?php 

define("STUDENT_DATA_FILE", $_SERVER['DOCUMENT_ROOT']."/data/student_data.json");

function createStudent($name, $usn, $auid, $branch) {

    // read data from the file 
    $file = fopen(STUDENT_DATA_FILE, 'r');
    $fileContent = file_get_contents(STUDENT_DATA_FILE);
    // convert the string to php object
    $studentDataObject = json_decode($fileContent);
    // close the file
    fclose($file);

    // get the id-generator value and increment it after the object is inserted
    $id = $studentDataObject->idCreator;

    // students array
    $students = [];
    if(isset($studentDataObject->students)) {
        // if the file contails the students data add it to students array
        $students = $studentDataObject->students;
    }

    print_r($students);

    //create the new student object
    $newStudent = [
        id => $id,
        name => $name,
        usn => $usn,
        auid => $auid,
        branch => $branch
    ];

    // add the current student to the array 
    array_push($students, $newStudent);

    // increment the idCreator
    $studentDataObject->idCreator++;

    // update the studentDataObject
    $studentDataObject->students = $students;

    // encode the json to string
    $encodedStudentObject = json_encode($studentDataObject,JSON_PRETTY_PRINT);

    // write the changes to the file
    $file = fopen(STUDENT_DATA_FILE, 'w');
    fwrite($file, $encodedStudentObject);
    fclose($file);

}   

function readStudents() {
    // read the students data file
    $fileContent = file_get_contents(STUDENT_DATA_FILE);
    
    //decode to php object
    $studentDataObject = json_decode($fileContent);

    // return the students array 
    return $studentDataObject->students;
}

function alertAndRedirect($message, $path) {
    echo "<script> 
        alert('$message');
        window.location='$path';
    </script>";
}