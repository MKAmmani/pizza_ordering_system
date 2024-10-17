<?php 

// including database connection
include("config/db_conn.php");
if (isset($_POST['delete'])){
       $id_to_delete = mysqli_real_escape_string($connct, $_POST['id_to_delete']);
       $sql = "DELETE FROM pizzas WHERE id = $id_to_delete"; 

       if(mysqli_query($connct, $sql)){
              // success
              header('Location: index.php');
       } else {
              // failure
              echo "query_error : ".mysqli_error($connct);
       }
}
// check GET request of id 
if(isset($_GET['id'])){
       $id = mysqli_real_escape_string($connct, $_GET['id']);
       
       // make the sql
       $sql = "SELECT * FROM pizzas WHERE id = $id";

       // get the result from the query
       $result = mysqli_query($connct, $sql);

       //fetching result in the form of array
       $pizza = mysqli_fetch_assoc($result);

       mysqli_free_result($result);
       mysqli_close($connct);
       
       //print_r($pizza);

}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templet/header.php'); ?>
<div class="container center">
      
       <?php if($pizza){ ?>
              <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
             <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?> </p>
              <p>Date: <?php echo htmlspecialchars($pizza['created_at']); ?></p>
             <h5>Ingredients:</h5>
              <p><?php  echo htmlspecialchars($pizza['ingredients']); ?></php>

              <!-- delete form -->
               <form action="details.php" method="POST">
                     <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
                     <input type="submit" name="delete" value="DELETE" class="btn brand">
               </form>

       <?php } else{ ?>
                     <h5>No such pizza exist!</h5>
              <?php } ?>
      
</div>
<?php include('templet/footer.php'); ?>
</html>