<?php
/**
 * Check submit button, take data and save to DB
 */
require_once("header.php");
require_once("database.php");
$db = new DBConnection();
$errors = [];

$majors = $db->getAllMajors()->fetchAll();

// if there is id in the URL, get data
if (isset($_GET["id"])) {
    $result = $db->getStudentById($_GET["id"]);
    $name = $nim = $phone = $major = "";
    if ($result) {
        $student = $result->fetch();
        $name = $student["name"];
        $nim = $student["nim"];
        $phone = $student["phone"];
        $major = $student["major_id"];
    }
}

if (isset($_POST["submit"])) {
    // check name first, set error if no value
    if (empty($_POST["name"])) {
        array_push($errors, "Name is required");
    }

    if (empty($_POST["nim"])) {
        array_push($errors, "NIM is required");
    } else {
        if (strlen($_POST["nim"]) != 12) {
            array_push($errors, "NIM is must be exactly 12 characters");
        }
    }

    // save data and go back to index.php (list of students)
    $name = $_POST["name"];
    $nim = $_POST["nim"];
    $phone = $_POST["phone"];
    $major = $_POST["major"];

    if (count($errors) == 0) {
        if (isset($_GET["id"])) {
            $db->updateStudent($_GET["id"], $name, $nim, $phone, $major);
        } else {
            $db->addStudent($name, $nim, $phone, $major);
        }
        header("Location: index.php");
    }
}
?>

<div class="container mt-4">
    <form class="form" action="" method="post">
        <div class="row mt-3">
            <div class="col-4">
                <label for="name">Student Name</label>
                <input class="form-control" type="text" name="name"
                    value="<?php echo($name); ?>" placeholder="Enter Student Name"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <label for="nim">Student NIM</label>
                <input class="form-control" type="text" name="nim"
                    value="<?php echo($nim); ?>" placeholder="Enter Student NIM"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <label for="phone">Student Phone</label>
                <input class="form-control" type="text" name="phone"
                    value="<?php echo($phone); ?>"placeholder="Enter Student Phone"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <label for="major">Student Major</label>
                <select class="form-select" name="major">
                    <?php
                        // NOTE: if the major == $row["id"], put `selected` attribute
                        foreach ($majors as $row) {
                            $selected = $row["id"] == $major ? "selected" : "";
                            echo("<option value=\"{$row['id']}\" {$selected}>");
                            echo("{$row['code']} - {$row['name']}");
                            echo("</option>");
                        }
                    ?>
                </select>
            </div>
        </div>
        <input class="mt-3 btn btn-primary" type="submit" name="submit" value="Add Record"/>
        <a class="mt-3 btn btn-warning" href="index.php">Cancel</a>
    </form>
    <div class="mt-4">
        <ul class="error">
            <?php
            foreach ($errors as $err) {
                echo("<li>{$err}</li>");
            }
            ?>
        </ul>
    </div>
</div>
