<?php

    include('config/db_connect.php');

    $title = $email = $ingredients = '';
    $error = array('email'=>'','title'=>'','ingredients'=>'');
    

    if(isset($_POST['submit'])){

        // check email validation
        if (empty($_POST['email'])){
            $error['email'] = 'An email is Required <br/>';
        } else{
            $email = $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $error['email'] = 'Email must be a valid email address';
            }
        }
        // check title validation
        if (empty($_POST['title'])){
            $error['title'] = 'A title is Required <br/>';
        } else{
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
                $error['title'] = 'Title must be letters and spaces only';
            }

        }
        // check ingredients validation
        if (empty($_POST['ingredients'])){
            $error['ingredients'] = 'At least one ingredients is Required <br/>';
        } else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
                $error['ingredients'] = 'Ingredients must be coma separated list';
            }
        }

        if(array_filter($error)){
            // echo 'error in the form'
        } else{

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            // create sql
            $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

            // save to db and check
            if(mysqli_query($conn,$sql)){
                // success
                header('location: dashboard.php');
            } else{
                // error
                echo 'query error:' . mysqli_error($conn);
            }   
        }

    }

?>
<!DOCTYPE html>
<html>
    <?php include('templates/header.php');?>

    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Moid & Ijaz & Awais Pizza</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="add.php" class="btn brand z-depth-0">Add a Pizza</a></li>
            </ul>
        </div>
    </nav> 
    
    <div class="container">
    <div class="container ">
    <section class=" grey-text">
        <h4 class="center">Add a Pizza</h4>
        <div class="container ">
        
        <form class="white" action="add.php" method="POST">

            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ; ?>">
            <div class="red-text"><?php echo $error['email'] ;?></div>

            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ; ?>">
            <div class="red-text"><?php echo $error['title'] ;?></div>

            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ; ?>">
            <div class="red-text"><?php echo $error['ingredients'] ;?></div>
            
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        
        </div>
        </form>
    </section>
    </div>
    </div>

    <?php include('templates/footer.php');?>


</html>