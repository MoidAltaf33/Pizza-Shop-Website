<?php
   include('config/db_connect.php');
    // echo "Connected successfully";

    // Inserting Data and Crud Operations
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if( ($_POST['username'] == "") || ($_POST['password'] == "")){
            echo "Fields Empty";
         }
         else{
        // get the form data
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "INSERT INTO blogdata (username, password) VALUES ('$username', '$password')";

        $result = mysqli_query($conn , $sql);
        header('Location: index.php');
         }
    }


    


    // $sql = "UPDATE blogdata SET username='Syed Irtaza' WHERE user_id=2";
    // $sql = "DELETE FROM blogdata WHERE user_id=6";
      
  #  if (mysqli_query($conn , $sql)){
  #      echo "Record Inserted";}
  #   } else{
  #      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  #   }

  #  mysqli_close($conn);
?>
<!DOCTYPE html>
<html >
<?php include('templates/header.php');?>
<nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Moid & Ijaz & Awais Pizza</a>
        </div>
    </nav>

<h2 class="center grey-text">Register Page</h2>
    <div class="container">
        <div class="container">

            <div class="container ">
                <form action="register.php" method="POST">
                    <div >
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div >
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div >
                        <button type="submit" name="submit" class="sb-btn btn btn-success">Submit</button>
                        <button type="reset" class="rs-btn btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('templates/footer.php');?>
</html>