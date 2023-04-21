<?php

    include('config/db_connect.php');

    // write query for all the pizzas
    $sql = 'SELECT title , ingredients , id FROM pizzas ORDER BY created_at';
    
    // make query & get result
    $result = mysqli_query($conn,$sql);

    // fetch the resulting row as an array
    $pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);

    // free the result from memory
    mysqli_free_result($result);

    // close the connection
    mysqli_close($conn);


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

    <h4 class="center grey-text">Pizzas!</h4>

    <div class="container">
        <div class="row">

            <?php foreach ($pizzas as $pizza): ?>
                
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="img/pizza.svg" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']) ;?></h6>
                            <ul>
                                <?php foreach (explode(',',$pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing)?></li>        
                              <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action center-align">
                            <a class="brand-text" href="detail.php?id=<?php echo $pizza['id'] ?>">more info</a>
                            
                            <a class="brand-text" href="update.php?id=<?php echo $pizza['id'] ?>">UPDATE ORDER</a>
                        
                        </div>
                     
                    </div>
                </div>
                
            <?php endforeach; ?>

            <?php if(count($pizzas)>=1):?>
                <p class="center"><?php echo htmlspecialchars(count($pizzas)) .' pizza' ;?></p>
            <?php endif;?>
        </div>
    </div>

    <?php include('templates/footer.php');?>


</html>