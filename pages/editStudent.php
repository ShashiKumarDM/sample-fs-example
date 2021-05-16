<?php 
    include $_SERVER['DOCUMENT_ROOT']."/phpScripts/functions.php";
    if(isset($_GET['id'])) {
        $student = getStudentById($_GET['id']);
    }else {
        alertAndRedirect("The provided info is wrong, Please try again with correct data", "/");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample FS Example | Edit Student</title>


    <!-- common css -->
    <link rel="stylesheet" href="../css/common.css">

    <!-- form css -->
    <link rel="stylesheet" href="../css/form.css">

</head>

<body>

    <main>
        <div class="form">
            <form action="../phpScripts/editStudent.php" method="POST">
                <h3>Edit Student</h3>
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="studentName" value="<?php echo $student->name; ?>" id="name">
                </div>
                <div class="input-group">
                    <label for="usn">USN</label>
                    <input type="text" name="studentUsn" value="<?php echo $student->usn; ?>" id="usn">
                </div>
                <div class="input-group">
                    <label for="auid">Auid</label>
                    <input type="text" name="studentAuid" value="<?php echo $student->auid; ?>" id="auid">
                </div>
                <div class="input-group">
                    <label for="branch">Branch</label>
                    <input type="text" name="studentBranch" value="<?php echo $student->branch; ?>" id="branch">
                </div>
                <input type="hidden" name="id" value="<?php echo $student->id; ?>">
                <input type="submit" class="btn btn-success center w-100" value="Update Student" name="addStudentData">
            </form>
        </div>
    </main>

</body>

</html>