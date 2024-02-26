<?php
/**
 * Check submit button, take data and save to DB
 */
require_once("header.php");
require_once("database.php");
$db = new DBConnection();
$errors = [];
if (isset($_POST["submit"])) {
    // check name first, set error if no value
    if (empty($_POST["name"])) {
        array_push($errors, "Name is required");
    }

    if (empty($_POST["code"])) {
        array_push($errors, "Code is required");
    } else {
        if (strlen($_POST["code"]) != 3) {
            array_push($errors, "Code is must be exactly 3 characters");
        }
    }

    // check the $errors array, if count is zero, then proceed, else just show errors
    if (count($errors) == 0) {
        $name = $_POST["name"];
        $code = $_POST["code"];
        // save data and go back to listMajor.php (list of majors)
        $db->saveMajor($name, $code);
        header("Location: listMajor.php");
    }
}
?>

<div class="container mt-4">
    <form class="form" action="" method="post">
        <div class="row mt-3">
            <div class="col-4">
                <label for="name">Major Name</label>
                <input class="form-control" type="text" name="name"
                    value="<?php echo($name);?>" placeholder="Enter Major Name"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
            <label for="code">Major Code</label>
                <input class="form-control" type="text" name="code"
                    value="<?php echo($code);?>" placeholder="Enter Major Code"/>
            </div>
        </div>
        <input class="mt-3 btn btn-success" type="submit" name="submit" value="Add Record"/>
    </form>
    <div class="mt-4">
        <ul>
            <?php
            foreach ($errors as $err) {
                echo("<li>{$err}</li>");
            }
            ?>
        </ul>
    </div>
</div>
