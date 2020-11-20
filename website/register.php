<?php
ob_start();
session_start(); // start a new session or continues the previous
if (isset($_SESSION['admin'])!=""){
   header("Location: homeA.php"); //redirects to admin site
   exit;
}
if (isset($_SESSION['user']) != "") {
   header("Location: home.php"); // redirects to home.php user site
   exit;
}
include_once 'actions/db_connect.php';
$error = false;
if (isset($_POST['btn-signup'])) {
   // sanitize user input to prevent sql injection
   $name = trim($_POST['name']);

   //trim - strips whitespace (or other characters) from the beginning and end of a string
   $name = strip_tags($name);

   // strip_tags — strips HTML and PHP tags from a string

   $name = htmlspecialchars($name);
   // htmlspecialchars converts special characters to HTML entities
   $email = trim($_POST['email']);
   $email = strip_tags($email);
   $email = htmlspecialchars($email);

   $pass = trim($_POST['pass']);
   $pass = strip_tags($pass);
   $pass = htmlspecialchars($pass);

   // basic name validation
   if (empty($name)) {
      $error = true;
      $nameError = "Please enter your full name.";
   } else if (strlen($name) < 3) {
      $error = true;
      $nameError = "Name must have at least 3 characters.";
   } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
      $error = true;
      $nameError = "Name must contain alphabets and space.";
   }

   //basic email validation
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $emailError = "Please enter valid email address.";
   } else {
      // checks whether the email exists or not
      $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
      $result = mysqli_query($connect, $query);
      $count = mysqli_num_rows($result);
      if ($count != 0) {
         $error = true;
         $emailError = "Provided Email is already in use.";
      }
   }
   // password validation
   if (empty($pass)) {
      $error = true;
      $passError = "Please enter password.";
   } else if (strlen($pass) < 6) {
      $error = true;
      $passError = "Password must have atleast 6 characters.";
   }

   // password hashing for security
   $password = hash('sha256', $pass);


   // if there's no error, continue to signup
   if (!$error) {

      $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
      $res = mysqli_query($connect, $query);

      if ($res) {
         $errTyp = "success";
         $errMSG = "<h3 class='text-center'>Successfully registered, you may login now</h3>";
         unset($name);
         unset($email);
         unset($pass);
      } else {
         $errTyp = "danger";
         $errMSG = "<h3 class='text-center'>Something went wrong, try again later</h3>";
      }
   }
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
   <title>Login & Registration System</title>
   <style>
      body {
         background: rgb(250, 237, 230);
         background: linear-gradient(90deg, rgba(250, 237, 230, 1) 0%, rgba(189, 208, 221, 1) 39%, rgba(196, 200, 220, 1) 68%, rgba(232, 156, 213, 1) 100%);
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

   <!-- header -->
   <header>
      <h1 class="text-center mt-5 m-4">Sign Up Now!</h1>
   </header>

   <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

      <main class="container">
         <hr />
         <?php
         if (isset($errMSG)) {

         ?>
            <div class="alert alert-<?php echo $errTyp ?>">
               <?php echo  $errMSG; ?>
            </div>

         <?php
         }
         ?>

         <div class="d-flex justify-content-center flex-column ">

            <div class="form-group justify-content-center">
               <label for="name"><b>Name:</b></label>
               <input type="text" name="name" class="form-control" placeholder="Enter your name" maxlength="50" value="<?php echo $name ?>" />
               <span class="text-danger"> <?php echo  $nameError; ?> </span>
            </div>
            <br>
            <div class="form-group">
               <label for="email"><b>Email:</b></label>
               <input type="email" name="email" class="form-control" placeholder="Enter your email" maxlength="40" value="<?php echo $email ?>" />
               <span class="text-danger"> <?php echo  $emailError; ?> </span>
            </div>

            <div class="form-group">
               <label for="password"><b>Password:</b></label>
               <input type="password" name="pass" class="form-control" placeholder="Enter your password" maxlength="25" />
               <span class="text-danger"> <?php echo  $passError; ?> </span>
            </div>
            <hr />

            <button type="submit" class="btn btn-block btn-success" name="btn-signup"><b>Sign Up</b></button>
         </div>
         <hr />

         <a href="index.php"> <button class="btn btn-outline-dark" type="button"><b>Sign in Here</b></button></a>
      </main>

   </form>
   <!-- Optional JavaScript -->

   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>