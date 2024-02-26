<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>
<body>
<?php
    require("database.php");
    include_once("nav.php");
    $db = new DBConnection();
    $majors = $db->getAllMajors();
?>
<div class="container mt-3">
    <table class="table table-sm table-bordered">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        // loop all majors and show in table
        foreach ($majors as $row) {
        ?>
        <tr>
            <td><?= $row["code"] ?></td>
            <td><?= $row["name"] ?></td>
            <td>
                <a class="btn btn-warning" href="majorForm.php?id=<?= $row['id'] ?>">Edit</a>
            </td>
            <td>
                <a class="btn btn-danger" href="deleteMajor.php?id=<?= $row['id']?>">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <div>
        <a class="btn btn-success" href="majorForm.php">Create</a>
    </div>
</div>
</body>
</html>