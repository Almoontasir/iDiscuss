<?php 
 $alert = "false";
  include '_dbConnect.php';
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];
      $sql = "select * from `users` WHERE user_email= '$email'";
      try{
        $result = mysqli_query($conn,$sql);

      
      }
      catch(mysqli_sql_exception $e)
      {
        die("could not execute due to this error->".mysqli_error());
      }
      $num = mysqli_num_rows($result);
      if($num>0)
      {
        $error = "alreadyexist";
        
       
      }
      else
      {
        if($password==$confirmPassword)
        {
            $hsh= password_hash($password,PASSWORD_DEFAULT);
        
            $sql = "INSERT INTO `users` (`user_email`,`user_name`, `user_pass`) VALUES ( '$email','$name', '$hsh')";
           
            try{
                $result = mysqli_query($conn,$sql);
        
              
              }
              catch(mysqli_sql_exception $e)
              {
                die("could not execute due to this error->".mysqli_error());
              }
           
            $showAlert = true;
            header("location:/php/harry/foram/index.php?signupsuccess=true");
            exit;
        }
        else
        {
            $error = "passwordmatch";
        }
      }
      
       header("location:/php/harry/foram/index.php?signupsuccess=false&error=$error");
  }