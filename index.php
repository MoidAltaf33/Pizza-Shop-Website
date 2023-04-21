<?php

include('config/db_connect.php');

  // check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // create the query
    $query = "SELECT * FROM blogdata WHERE username='$username' AND password='$password'";

    // execute the query
    $result = mysqli_query($conn, $query);

    // check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
      // start a new session or set a cookie
      session_start();
      $_SESSION['username'] = $username;
      // redirect to the protected page
      header('Location: dashboard.php');
    } else {
      // display an error message
      echo "Invalid username or password.";
    }
  }

?>
<!DOCTYPE html>
<html>
    <?php include('templates/header.php');?>
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Moid & Ijaz & Awais Pizza</a>
        </div>
    </nav>


    <h2 class="center grey-text">Login Page</h2>
    <div class="container">
      <div class="container">

        <div class="container ">
          <form action="index.php" method="POST">
              <div class="card z-depth-0">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username">
                </div>
              <div class="card z-depth-0">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              <div >
                  <button type="submit" name="submit" class="sb-btn btn btn-success">Login</button>
                  <a href="register.php" class="btn btn-primary">Register</a>
              </div>
            </form>
        </div>
      </div>
      </div>
      <?php include('templates/footer.php');?>
</html>