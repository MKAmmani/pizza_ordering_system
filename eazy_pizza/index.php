<?php

include("config/db_conn.php");
// write the query for pizzas/ and selecting datas from database
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';
// gettin the result
$result = mysqli_query($connct, $sql);
// fetching the results
$pizzas = mysqli_fetch_all( $result, MYSQLI_ASSOC);
// free the result from memory
mysqli_free_result($result);
// CLOSING TE CONNECTION 
mysqli_close($connct);

//print_r( $pizzas);
// explode function is used to create an array
//(explode(',' , $pizzas['0']['ingrediantes']));

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templet/header.php'); ?>
<h4 class="center">Pizzas!</h4>

<div class="container">

       <div class="row">
              <?php foreach ($pizzas as $pizza) { ?>
                     
                     <div class="col s6 md3">
                            <div class="card">
                                   <div class="card-content center">
                                          <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                                          <div><?php echo htmlspecialchars($pizza['ingredients']) ?></div>
                                   </div>
                                   <div class="right-align ">
                                          <a href="details.php?id=<?php echo $pizza['id']; ?>" class="brand-text">! more info </a>
                                   </div>
                            </div>
                     </div>
              <?php } ?>
       </div>
</div>
<?php include('templet/footer.php'); ?>
      

</html>
