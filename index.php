<?php 
    include "./phpScripts/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample FS project</title>

    <!-- common css -->
    <link rel="stylesheet" href="./css/common.css">

    <!-- custom css -->
    <link rel="stylesheet" href="./css/index.css">

</head>
<body>

    <main>
        <h2>Welcome to FS Sample Example</h2>

        <div class="add-buton-div">
            <a href="./html/addStudent.html" class="btn btn-success">Add Student</a>
        </div>

        <table>
            <thead>
                <th>Name</th>
                <th>USN</th>
                <th>AUID</th>
                <th>Branch</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php 

                    $students = readStudents();
                    foreach ($students as $student) {
                        echo "
                            <tr> 
                                <td> $student->name </td>
                                <td> $student->usn </td>
                                <td> $student->auid </td>
                                <td> $student->branch </td>
                                <td> </td>
                            </tr>
                        ";
                    }

                ?>
            </tbody>
        </table>
    </main>
    
</body>
</html>