<?php

ob_start();
session_start();

require_once 'actions/db_connect.php';

// if session is not admin it get redirected to the user page
if (isset($_SESSION["admin"]) || isset($_SESSION["superadmin"])) {
} else {
    header("Location: home.php");
}

if ($_GET['id']) {
    $id = $_GET['id'];
    // connect database with entry
    $sql = "SELECT * FROM users WHERE userID = $id";
    $result = mysqli_query($connect, $sql);
    $data = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <nav class="navbar sticky-top fixed navbar-light bg-light">
        <form class="form-inline">
            <a class="navbar-brand" href="index.php">Home</a>
            <a href="create.php"><button class="btn btn-warning" type="button">Add Media Entry</button></a>
        </form>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center m-4">Edit User</h2>

        <form action="actions/a_editU.php" method="post">
            <h3 class="mt-4">Basic Information:</h3>
            <hr>
            <div class="form-group">
                <label for="userName">User Name:</label>
                <input type="text" name="userName" class="form-control" placeholder="Insert the animal name here" value="<?php echo $data['userName'] ?>" />
            </div>

            <div class="form-group">
                <label for="userEmail">User email:</label>
                <input type="text" name="userEmail" class="form-control" placeholder="Insert the image URL here" value="<?php echo $data['userEmail'] ?>" />
            </div>
            <div class="form-group">
                <label for="userType">Access Privilege:</label>
                <select name="userType" class="form-control" value="<?php echo $data['userType'] ?>">
                    <option>user</option>
                    <option>admin</option>
                    <option>superadmin</option>
                </select>
            </div>

            <input type="hidden" name="userID" value="<?php echo $data['userID'] ?>" />

            <!-- button to submit content -->
            <button class="btn btn-success" type="submit">Save Changes</button>
            <!-- button to go back -->
            <a href="users.php"><button class="btn btn-dark" type="button">Back</button></a>
        </form>
    </div>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>