<?php
/**
 * Check submit button, take data and save to DB
 */
require_once("header.php");
require_once("database.php");
$db = new DBConnection();
$errors = [];

// if there is id in the URL, get data
if (isset($_GET["id"])) {
    $result = $db->getMajorById($_GET["id"]);
    $name = $code = "";
    if ($result) {
        $major = $result->fetch();
        $name = $major["name"];
        $code = $major["code"];
    }
}

// button is clicked
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

    $name = $_POST["name"];
    $code = strtoupper($_POST["code"]);
    // check the $errors array, if count is zero, then proceed, else just show errors
    if (count($errors) == 0) {
        // save data and go back to listMajor.php (list of majors)
        // if there is id, we need to update, else create new
        if (isset($_GET["id"])) {
            $db->updateMajor($_GET["id"], $name, $code);
        } else {
            $db->addMajor($name, $code);
        }
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
        <input class="mt-3 btn btn-primary" type="submit" name="submit" value="Save Record"/>
        <a class="mt-3 btn btn-warning" href="listMajor.php">Cancel</a>
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
