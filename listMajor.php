<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>
<body>
<?php include_once("nav.php"); ?>
<div class="container mt-3">
    <table class="table table-sm table-bordered">
        <tr>
            <th>Code</th>
            <th>Name</th>
        </tr>
    <?php
    require("database.php");
    $db = new DBConnection();
    $students = $db->getAllMajors();
    foreach ($students as $student) {
        echo("<tr>");
        echo("<td>{$student['code']}</td>");
        echo("<td>{$student['name']}</td>");
        echo("</tr>");
    }
    ?>
    </table>
    <div>
        <a class="btn btn-success" href="majorForm.php">Create</a>
    </div>
</div>
</body>
</html>