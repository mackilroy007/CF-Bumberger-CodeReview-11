<?php

ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not admin this will redirect to user page
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}


if ($_GET['id']) {
    $id = $_GET['id'];
    // connect database with entry
    $sql = "SELECT * FROM animals WHERE animalID = $id";
    $result = mysqli_query($connect, $sql);
    $data = $result->fetch_assoc();
}
?>
<?php

// select logged-in users details
$res = mysqli_query($connect, "SELECT * FROM users WHERE userId=" . $_SESSION['admin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
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
    <title>Delete Entry</title>
</head>

<body>

    <nav class="navbar sticky-top fixed navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Home</a>
        <form class="form-inline">
            <a class="navbar-brand" href="#">Welcome - <?php echo $userRow['userName']; ?></a>
            <a href="../logout.php?logout"><button class="btn btn-outline-primary" type="button">Sign Out</button></a>
        </form>
    </nav>

    <div class="container text-center">
        <h2 class="m-4">Do you really want to delete this entry?</h2>

        <form action="actions/a_delete.php" method="post">
            <input type="hidden" name="animalID" value="<?php echo $data['animalID'] ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it!</button>
            <a href="homeA.php"><button class="btn btn-dark" type="button">No, go back!</button></a>
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