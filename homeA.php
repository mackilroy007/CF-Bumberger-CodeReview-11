<?php

ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not admin it get redirected to the user page
if (!isset($_SESSION["admin"])) {
    header("Location: home.php");
}

// select logged-in users details (user or admin)
if (isset($_SESSION['user'])) {
    $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
} else {
    $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=" . $_SESSION['admin']);
}

$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
// var_dump($_SESSION);
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
    <title>PHP CRUD Restaurant</title>

    <style type="text/css">
        body {
            background-color: white;
        }

        img {
            height: 10em;
            width: 12em;
        }
    </style>

</head>

<body>

    <nav class="navbar sticky-top fixed navbar-light bg-light">
        <form class="form-inline">
            <a class="navbar-brand" href="home.php">Home</a>
            <a href="create.php"><button class="btn btn-warning" type="button">Add Pet</button></a>
            <!-- jump to the user site -->
            <a href="homeA.php"><button class="btn btn-primary  ml-2" type="button">User Preview Site</button></a>
            <!--  -->
        </form>
        <form class="form-inline">
            <a class="navbar-brand" href="#">Welcome - <?php echo $userRow['userName']; ?></a>
            <a href="logout.php?logout"><button class="btn btn-outline-primary" type="button">Sign Out</button></a>
        </form>
    </nav>

    <main>
        <div class="container-fluid">
            <table class="table">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age (years)</th>
                        <th scope="col">Size</th>
                        <th scope="col">Location</th>
                        <th scope="col">Short BIO</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $sql = "SELECT * FROM animals";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo  "<tr scope='row'>
                       <td>" . $row['animalName'] . "</td>
                       <td><img src=" . $row['img'] . "></td>
                       <td>" . $row['gender'] . "</td>
                       <td>" . $row['age'] . "</td>
                       <td>" . $row['size'] . "</td>
                       <td>" . $row['address'] . ', ' . $row['zip'] . ',' . $row['city'] . "</td>
                       <td>" . $row['description'] . "</td>
                       <td>
                       <a href='edit.php?id=" . $row['animalID'] . "'><button class='btn btn-outline-primary mb-1' type='button'>Edit</button></a>
                       <a href='delete.php?id=" . $row['animalID'] . "'><button class='btn btn-outline-danger' type='button'>Delete</button></a>
                       </td>
                   </tr>";
                        }
                    } else {
                        echo  "<tr scope='row'>
                                    <td colspan='12'><center>No Data Avaliable</center></td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>