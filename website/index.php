<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if loop will never let you open index(login) page if session is not set
if (isset($_SESSION['admin']) != "") {
    header("Location: homeA.php"); //redirects to admin site
    exit;
}
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php user site
    exit;
}
if (isset($_SESSION['superadmin']) != "") {
    header("Location: homeA.php"); // redirects to home.php admin site
    exit;
}


$error = false;

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        $res = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$email'");
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

        if ($count == 1 && $row['userPass'] == $password) {

            if ($row["userType"] == "user") {
                $_SESSION["user"] = $row["userID"];
                header("Location: home.php");
            } else if ($row["userType"] == "admin") {
                $_SESSION["admin"] = $row["userID"];
                header("Location: homeA.php");
            } else if ($row["userType"] == "superadmin") {
                $_SESSION["superadmin"] = $row["userID"];
                header("Location: homeA.php");
            }
        } else {
            $errMSG = "<h4 class='text-center'>Incorrect Credentials, Try again</h4>";
        }
    }
}
// echo $_SESSION['user'];
// echo $_SESSION['admin'];
// echo $_SESSION['superadmin'];
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
    <title>Login & Registration System</title>
    <style>
        body {
            background: rgb(250, 237, 230);
            background: linear-gradient(90deg, rgba(250, 237, 230, 1) 0%, rgba(210, 192, 195, 1) 52%, rgba(89, 81, 87, 1) 100%);
        }

        hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid black;
            margin: 1em 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar sticky-top fixed navbar-dark bg-dark">
        <form class="form-inline">
            <a class="navbar-brand" href="index.php">Home</a>
        </form>
    </nav>
    <main class="container">
        <!-- header -->
        <header class="text-center mt-5 m-4">
            <h1>Welcome!</h1>
        </header>
        <hr />
        <!-- form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <?php
            if (isset($errMSG)) {
                echo  $errMSG; ?>

            <?php
            }
            ?>
            <div class="form-group">
                <label for="email"><b>Email:</b></label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php echo $email; ?>" maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group"></div>
            <label for="pass"><b>Password:</b></label>
            <input type="password" name="pass" class="form-control" placeholder="Enter your password" maxlength="25" />
            <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            <hr />
            <button class="btn btn-success btn-block" type="submit" name="btn-login"><b>Sign In</b></button>


            <hr />

            <a href="register.php"><button class="btn btn-outline-dark" type="button"><b>Sign Up Here</b></button></a>
        </form>

    </main>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>