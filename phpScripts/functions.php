<?php 

define("STUDENT_DATA_FILE", $_SERVER['DOCUMENT_ROOT']."/data/student_data.json");

function createStudent($name, $usn, $auid, $branch) {

    // read data from the file 
    // $file = fopen(STUDENT_DATA_FILE, 'r');
    $fileContent = file_get_contents(STUDENT_DATA_FILE);
    // convert the string to php object
    $studentDataObject = json_decode($fileContent);
    // close the file
    // fclose($file);

    // get the id-generator value and increment it after the object is inserted
    $id = $studentDataObject->idCreator; // 4

    // students array
    $students = []; 
    if(isset($studentDataObject->students)) {
        // if the file contails the students data add it to students array
        $students = $studentDataObject->students;
    }

    // print_r($students);

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
    $encodedStudentObject = json_encode($studentDataObject, JSON_PRETTY_PRINT);

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

function getStudentById($requiredId) {

    // required index
    $index = -1;

    // get the students data
    $students = readStudents();
    // find student by id
    foreach($students as $studentIndex => $student) {
        if($student->id === intval($requiredId)) {
            $index = $studentIndex;
        }
    }
    // return the student object if found
    if($index !== -1) {
        return $students[$index];
    } else {
        alertAndRedirect("Requitred Student wass not found, Please try again", "/");
    } 
}

function updateStudent($requiredId, $name, $usn, $auid, $branch) {

    // get the students array
    $file = file_get_contents(STUDENT_DATA_FILE);
    $studentDataObject = json_decode($file);
    $students = $studentDataObject->students;

    // create the updated student object 
    $updatedStudent = [
        id => $requiredId,
        name => $name,
        usn => $usn,
        auid => $auid,
        branch => $branch
    ];

    // find the index by id
    $index = -1;
    foreach ($students as $ind => $student) {
        if ($student->id === $requiredId) {
            $index = $ind;
        }
    }



    // replace the old object with new object
    echo "index".$index;
    if($index !== -1) {
        $students[$index] = $updatedStudent;
    }else {
        alertAndRedirect("The data provided was not correct, try again", "/");
        exit();
    }


    // update the file with updated data 
    $studentDataObject->students = $students;
    $file = fopen(STUDENT_DATA_FILE, 'w');
    $string = json_encode($studentDataObject, JSON_PRETTY_PRINT);
    fwrite($file, $string);
    fclose($file);

}

function deteleStudent($requiredId) {

    // get the students
    $file = file_get_contents(STUDENT_DATA_FILE);
    $studentDataObject = json_decode($file);
    $students = $studentDataObject->students;

    // innd and delete the perticular student object
    $index = -1;

    foreach($students as $ind => $student) {
        if ($student->id === $requiredId) {
            $index = $ind;
        } 
    }

    if($index !== -1 ) {
        array_splice($students, $index, 1);
    }else {
        alertAndRedirect("The id provided is wrong", "/");
    }

    // update the file with updated data 
    $studentDataObject->students = $students;
    $file = fopen(STUDENT_DATA_FILE, 'w');
    $string = json_encode($studentDataObject, JSON_PRETTY_PRINT);
    fwrite($file, $string);
    fclose($file);

}

function alertAndRedirect($message, $path) {
    echo "<script> 
        alert('$message');
        window.location='$path';
    </script>";
}