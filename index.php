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
            <th>Major</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    <?php
    require("database.php");
    $db = new DBConnection();
    $students = $db->getAllStudents();
    foreach ($students as $row) {
        $major = $db->getMajorById($row['major_id'])->fetch();
    ?>
    <tr>
        <td><?= $row["name"]; ?></td>
        <td><?= $row["nim"]; ?></td>
        <td><?= $row["phone"]; ?></td>
        <td><?= $major["name"] ?></td>
        <td>
            <a class="btn btn-warning" href="studentForm.php?id=<?= $row['id']; ?>">Edit</a>
        </td>
        <td>
            <a class="btn btn-danger" href="deleteStudent.php?id=<?= $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php
    }
    ?>
    </table>
    <div>
        <a class="btn btn-success" href="studentForm.php">Add New Data</a>
    </div>
</div>
</body>
</html>