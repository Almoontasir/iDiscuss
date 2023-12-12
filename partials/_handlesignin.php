<?php 
$loginerror = "strat";
 $alert = "false";
  include '_dbConnect.php';

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {

      $email = $_POST['email'];
      $password = $_POST['password'];
      $sql = "select * from `users` WHERE user_email= '$email'";
      try{
        $result = mysqli_query($conn,$sql);

      
      }
      catch(mysqli_sql_exception $e)
      {
        die("could not execute due to this error->".mysqli_error());
      }
      $num = mysqli_num_rows($result);
      if($num==1)
      {
        $row = mysqli_fetch_assoc($result);
       if( password_verify($password,$row['user_pass']))
       {
           $username = $row['user_name'];
           $sl = $row['slno'];
           session_start();
           $_SESSION['login']=true;
           $_SESSION['username']=$username;
           $_SESSION['sl']=$sl;
           echo var_dump($_SESSION['login']);
           echo var_dump($_SESSION['email']);
           header("location:/php/harry/foram/index.php?login=true");
          //  exit;

       }
       else
       {
         $loginerror ="wrongPassword";
         header("location:/php/harry/foram/index.php?error=$loginerror");
       }
      }
      else
      {
        $loginerror ="EmailFound";
        header("location:/php/harry/foram/index.php?error=$loginerror");
      }
      // header("location:/php/harry/foram/index.php?error=$loginerror");

  }
  ?>  