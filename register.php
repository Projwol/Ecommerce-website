<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

 
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="post" name="Form" onsubmit="return validateForm()">
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your username" required>
      <input type="text" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <input type="submit" class="btn" name="submit" value="register now">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>

<script type="text/javascript">
function validateForm() {

    let name = document.forms["Form"]["name"].value;
    let email = document.forms["Form"]["email"].value;
    let pass = document.forms["Form"]["pass"].value;
    if (name=="") {  
            alert("Name is required");   
            return false;  
        } 
    if (!isNaN(name))  {
             alert("Name canot be a number");
             return false;
        }
  if (name.length<3)  {
      alert("Name must be 3 character");
      return false;
  }
  if (name.length>20)  {
      alert("Name must be less than 20 character");
      return false;
  }
        
    if (email == "") {
      alert("email must be filled out");
      return false;
    }
  if (email.indexOf('@')<=0)  {
      alert("@ invalid position");
      return false;
  }  if (email.charAt(email.length-4)!='.') {
      alert(". invalid position");
      return false;
  }
  if (pass == "") {
      alert("Password must be filled out");
      return false;
    }
  if (pass.length<6)  {
      alert("Password cannot be less than 6 letter");
      return false;
  }
  if (pass.length>15)  {
      alert("Password must be less than 15 character");
      return false;
  } 

}
</script>

</body>
</html>