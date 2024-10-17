<?php
include("config/db_conn.php");
// intializing variables to be empty strings so that we can use the value functiong well
$title = $email = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if(isset($_POST["submit"])){
       
// check for email
       if(empty($_POST['email'])){
               $errors['email'] = 'An email is required <br/>';
       } else{
              // vALIDATING THE EMAIL
              $email = $_POST['email'];
              if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 $errors['email'] = 'input a valid email addres';
              }
       }

       // check for title
       if(empty($_POST['title'])){
              $errors['title'] = 'A title is required <br/>';
       } else{
              // VALIDATING THE TITLE
             $title = $_POST['title'];
             if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
              $errors['title'] = 'title must be a letters space only';
             }
       }
       // check for ingredients
       if(empty($_POST['ingredients'])){
              $errors['ingredients'] = 'At least one ingredients  is required <br/>';
       } else{
              // Validation of the ingredients
              $ingredients = $_POST['ingredients'];
              if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-z\s]*)*$/', $ingredients)){
                     $errors['ingredients'] = 'ingredients must be letters and space only and sapareated by a comma'; 
              }
       }

       if(array_filter($errors)){

       } else{

              // preventing databse from unwanted codes/maliciuos
              $email = mysqli_real_escape_string($connct, $_POST['email']);
              $title = mysqli_real_escape_string($connct, $_POST['title']);
              $ingredients = mysqli_real_escape_string($connct, $_POST['ingredients']);

              // adding data to database
              $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

              // making query
              if(mysqli_query($connct, $sql)){
                     header('location: index.php');
              } else{
                     echo 'query erorr: ' . mysqli_error($connct);
              }
              
       }
}
              

?>

<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
</head>
<body>
<?php include('templet/header.php'); ?>
<section class="container grey-text">
       <h4 class="center">Add a Pizza</h4>
       <form action="" class="white" method="POST">
              <label>Email</label>
              <input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>" >
              <div class="red-text"><?php echo $errors['email']; ?></div>

              <label>pizza title</label>
              <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" >
              <div class="red-text"><?php echo $errors['title']; ?></div>

              <label>ingredients (comma separated);</label>
              <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
              <div class="red-text"><?php echo $errors['ingredients']; ?></div>

              <div class="center">
                     <input type="submit" name="submit" value="submit" class="btn brand">
              </div>
       </form>
</section>

<?php include('templet/footer.php'); ?>
</body>
</html>