<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// select logged-in users details (user or admin)
if(isset($_SESSION['user'])){
    $res = mysqli_query($connect, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
} else{
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
            background-color: #bbe8b5;
        }

        img {
            height: 20em;
        }
    </style>

</head>

<body>

    <nav class="navbar sticky-top fixed navbar-light bg-light">
        <form class="form-inline">
            <a class="navbar-brand" href="home.php">Home</a>
            <!-- go to admin button only vis for administrators -->
            <?php if(isset($_SESSION["admin"])){
                echo"<a href='home.php'><button class='btn btn-warning' type='button'>Go to Admin page</button></a>";
            }
                ?>
            <!-- end of admin button -->
        </form>
        <form class="form-inline">
            <a class="navbar-brand" href="#">Welcome - <?php echo $userRow['userName']; ?></a>
            <a href="../logout.php?logout"><button class="btn btn-outline-primary" type="button">Sign Out</button></a>
        </form>
    </nav>

    <main>
        <?php

        $sql = "SELECT * FROM meal";
        $result = $connect->query($sql);
        $result = mysqli_query($connect, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "  
                            <article class='container mt-4'>
                                <div class='card mb-3'>
                                    <img src='" . $row['img'] . "' class='card-img-top' alt='" . $row['m_name'] . "'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>" . $row['m_name'] . "</h5>
                                        <p class='card-text'>Price: " . $row['price'] . "$</p>
                                        <p class='card-text'>Ingredients: " . $row['ingredients'] . "</p>
                                        <p class='card-text'>Allergies: " . $row['allergies'] . "</p>
                                    </div>
                                </div>
                            </article>";
            }
        } else {
            echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
        }


        ?>
    </main>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>