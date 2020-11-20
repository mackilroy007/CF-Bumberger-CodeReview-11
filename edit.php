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
    $sql = "SELECT * FROM animals WHERE animalID = $id";
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
    <title>Edit Entry Content</title>
</head>

<body>
    <nav class="navbar sticky-top fixed navbar-light bg-light">
        <form class="form-inline">
            <a class="navbar-brand" href="homeA.php">Home</a>
            <a href="create.php"><button class="btn btn-warning" type="button">Add Media Entry</button></a>
        </form>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center m-4">Modify the media entry</h2>

        <form action="actions/a_edit.php" method="post">
            <h3 class="mt-4">Basic Information:</h3>
            <hr>
            <div class="form-group">
                <label for="animalName">Animal Name:</label>
                <input type="text" name="animalName" class="form-control" placeholder="Insert the animal name here" value="<?php echo $data['animalName'] ?>" />
            </div>

            <div class="form-group">
                <label for="img">Image URL format:</label>
                <input type="text" name="img" class="form-control" placeholder="Insert the image URL here" value="<?php echo $data['img'] ?>" />
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">Age in Years:</label>
                <input type="numbers" name="age" class="form-control" placeholder="Insert the age in years" value="<?php echo $data['age'] ?>" />
            </div>
            <div class="form-group">
                <label for="size">Animal Size:</label>
                <select name="size" class="form-control" value="<?php echo $data['size'] ?>">
                    <option>small</option>
                    <option>large</option>
                </select>
            </div>
            <h3 class="mt-4">Location Infromation:</h3>
            <hr>
            <div class="form-group">
                <label for="address">Street Name and House Number:</label>
                <input type="text" name="address" class="form-control" placeholder="Insert the street name and house number" value="<?php echo $data['address'] ?>" />
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code:</label>
                <input type="text" name="zip" class="form-control" placeholder="Enter ZIP code of the anmilas location" value="<?php echo $data['zip'] ?>" />
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" class="form-control" placeholder="Enter the City/Village location of the animal" value="<?php echo $data['city'] ?>" />
            </div>
            <div class="form-group">
                <label for="description">A short description:</label>
                <input type="text" name="description" class="form-control" placeholder="Add a short description (max 500 char)" value="<?php echo $data['description'] ?>" />
            </div>
            <hr>

            <input type="hidden" name="animalID" value="<?php echo $data['animalID'] ?>" />
            <!-- button to submit content -->
            <button class="btn btn-success" type="submit">Save Changes</button>
            <!-- button to go back -->
            <a href="homeA.php"><button class="btn btn-dark" type="button">Back</button></a>
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