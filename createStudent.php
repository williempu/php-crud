<?php
/**
 * Check submit button, take data and save to DB
 */
require_once("header.php");
require_once("database.php");
$db = new DBConnection();
if (isset($_POST["submit"])) {
    // TODO get data

    // save data and go back to index.php (list of students)
    $db->saveStudent($name, $nim, $phone, $major);
    header("Location: index.php");
}
?>

<div class="container mt-4">
    <form class="form" action="" method="post">
        <div class="row mt-3">
            <div class="col-4">
                <label for="studentName">Student Name</label>
                <input class="form-control" type="text"
                name="studentName" placeholder="Enter Student Name"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
            <label for="studentNIM">Student NIM</label>
                <input class="form-control" type="text"
                    name="studentNIM" placeholder="Enter Student NIM"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
            <label for="phone">Student Phone</label>
                <input class="form-control" type="text"
                    name="phone" placeholder="Enter Student Phone"/>
            </div>
        </div>
        <input class="mt-3 btn btn-success" type="submit" name="submit" value="Add Record"/>
    </form>
</div>
