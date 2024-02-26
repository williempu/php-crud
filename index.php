<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>
<body>
<?php include_once("nav.php"); ?>
<div class="container mt-3">
    <table class="table table-sm table-bordered">
        <tr>
            <th>Name</th>
            <th>NIM</th>
            <th>Phone</th>
        </tr>
    <?php
    require("database.php");
    $db = new DBConnection();
    $students = $db->getAllStudents();
    foreach ($students as $student) {
        echo("<tr>");
        echo("<td>{$student['name']}</td>");
        echo("<td>{$student['nim']}</td>");
        echo("<td>{$student['phone']}</td>");
        echo("</tr>");
    }
    ?>
    </table>
    <div>
        <a class="btn btn-success" href="createStudent.php">Create</a>
    </div>
</div>
</body>
</html>